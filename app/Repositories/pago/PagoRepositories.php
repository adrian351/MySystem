<?php
namespace App\Repositories\pago;
// Models
use App\Models\Pago;
// Notifications
use App\Notifications\pago\NotificacionPagoRegistrado;
use App\Notifications\pago\NotificacionPagoRechazado;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
use App\Events\layouts\ArchivosEliminados;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;
use App\Repositories\sistema\plantilla\PlantillaRepositories;
use App\Repositories\sistema\sistema\SistemaRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class PagoRepositories implements PagoInterface {
  protected $serviceCrypt;
  protected $pedidoActivoRepo;
  protected $plantillaRepo;
  protected $sistemaRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PedidoActivoRepositories $pedidoActivoRepositories, PlantillaRepositories $plantillaRepositories, SistemaRepositories $sistemaRepositories) {
    $this->serviceCrypt     = $serviceCrypt;
    $this->pedidoActivoRepo = $pedidoActivoRepositories;
    $this->plantillaRepo    = $plantillaRepositories;
    $this->sistemaRepo      = $sistemaRepositories;
  }
  public function getPagoFindOrFailById($id_pago, $relaciones, $estatus) {
    $id_pago = $this->serviceCrypt->decrypt($id_pago);
    return Pago::with($relaciones)->estatus($estatus)->findOrFail($id_pago);
  }
  public function getPagination($request) {
    if($request->paginador == null) {
      $paginador = 40;
      // $paginador 
    }else {
      $paginador = $request->paginador;
    }


    return Pago::with('pedido', 'usuario')->buscar($request->opcion_buscador, $request->buscador)->orderByRaw('estat_pag ASC, id DESC')->paginate($paginador);
    // return Pago::with('pedido', 'usuario')->buscar($request->opcion_buscador, $request->buscador)->latest()->paginate($request->paginador);
  }
  public function store($request, $id_pedido) {
    try { DB::beginTransaction();
      $pedido = $this->pedidoActivoRepo->getPedidoFindOrFail($id_pedido, ['usuario']);
      $pago = new Pago();
      $pago->cod_fact       = $this->generateRandomString();
      $pago->not            = $request->not; // Este campo solo se le asigna un valor cuando solo se genera un codigo de facuración
      $pago->form_de_pag    = $request->forma_de_pago;

      if($pago->form_de_pag != 'Efectivo (Jonathan)' AND $pago->form_de_pag != 'Efectivo (Gabriel)' AND $pago->form_de_pag != 'Efectivo (Fernando)' AND $pago->form_de_pag != 'Efectivo (Muestras/Garantías)') {
        $pago->fol            = $request->ultimos_8_digitos_del_folio_de_pago;
      } else {
        $pago->fol            = null;
      }
      
      $pago->mont_de_pag    = $request->monto_del_pago;
      $pago->coment_pag_vent  = $request->comentarios_ventas;
      $pago->pedido_id      = $pedido->id;   
      $pago->user_id        = $pedido->user_id; 
      $pago->created_at_pag = Auth::user()->email_registro;
      if($request->hasfile('comprobante_de_pago')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('comprobante_de_pago'), // Archivo blob
          'pedidos/'.date("Y").'/'.$pedido->num_pedido, // Ruta en la que guardara el archivo
          'comprobante_de_pago-'.time().'.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        ); 
        $pago->comp_de_pag_rut  = $imagen[0]['ruta'];
        $pago->comp_de_pag_nom  = $imagen[0]['nombre'];
      } else {
        $pago->estat_pag = config('app.rechazado');
      }
      if($request->hasfile('copia_de_identificacion')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('copia_de_identificacion'), // Archivo blob
          'pedidos/'.date("Y").'/'.$pedido->num_pedido, // Ruta en la que guardara el archivo
          'copia_de_identificacion-'.time().'.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        ); 
        $pago->cop_de_indent_rut  = $imagen[0]['ruta'];
        $pago->cop_de_indent_nom  = $imagen[0]['nombre'];
      }
      $pago->save();
      $pago->cod_fact .= $pago->id;
      $pago->save();
      $this->pedidoActivoRepo->getEstatusPagoPedido($pedido);
     
      // SI CUMPLE CON LA CONFICION SE MODIFICA EL ESTATUS DE PRODUCCIÓN Y ALMACEN PARA QUE LO PUEDAN VISUALIZAR
      if($pedido->mont_tot_de_ped <= 25000 AND $pedido->estat_produc == config('app.pendiente')) {
        $this->modificarEstatusProduccionYAlmacen($pedido);
      }

      // NOTIFICA AL USUARIO VIA CORREO ELECTRONICO QUE SU PAGO HA SIDO REGISTRADO
      $plantilla = $this->plantillaRepo->plantillaFindOrFailById($this->sistemaRepo->datos('plant_pag_reg_pag'));
      $pedido->usuario->notify(new NotificacionPagoRegistrado($pedido->usuario, $pago, $pedido->num_pedido, $plantilla)); // Envió de correo electrónico

      DB::commit();
      return $pago;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function update($request, $id_pago) {
    try { DB::beginTransaction();
      $pago = $this->getPagoFindOrFailById($id_pago, ['pedido', 'usuario'], null);
      $pago->estat_pag  = $request->estatus_pago;
      $pago->coment_pag = $request->comentarios;

      if($pago->isDirty('estat_pag')) {
        if($pago->estat_pag == config('app.aprobado')) {
          $pago->user_aut = Auth::user()->email_registro;
        } else {
          $pago->user_aut = null;
        }
      }

      if($pago->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Pagos (Individual)', // Módulo
          'pago.show', // Nombre de la ruta
          $id_pago, // Id del registro debe ir encriptado
          $pago->cod_fact, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Estatus pago', 'Comentarios', 'Usuario que autorizo el pago'), // Nombre de los inputs del formulario
          $pago, // Request
          array('estat_pag', 'coment_pag', 'user_aut') // Nombre de los campos en la BD
        ); 
        $pago->updated_at_pag  = Auth::user()->email_registro;
      }
      $pago->save();
      
      $this->pedidoActivoRepo->getEstatusPagoPedido($pago->pedido);

      // NOTIFICA AL USUARIO VIA CORREO ELECTRONICO QUE SU PAGO HA SIDO RECHAZADO
      if($request->checkbox_correo == 'on') {
        if($pago->estat_pag == config('app.rechazado')) {
          $plantilla = $this->plantillaRepo->plantillaFindOrFailById($this->sistemaRepo->datos('plant_pag_pag_rech'));
          $pago->usuario->notify(new NotificacionPagoRechazado($pago->usuario, $pago, $pago->pedido->num_pedido, $plantilla)); // Envió de correo electrónico
        }
      }

      // SI CUMPLE CON LA CONFICION SE MODIFICA EL ESTATUS DE PRODUCCIÓN Y ALMACEN PARA QUE LO PUEDAN VISUALIZAR
      if($pago->estat_pag == config('app.aprobado')) {
        $this->modificarEstatusProduccionYAlmacen($pago->pedido);
      }

      DB::commit();
      return $pago;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function updateFpedido($request, $id_pago) {
    try { DB::beginTransaction();
      $pago = $this->getPagoFindOrFailById($id_pago, ['pedido'], config('app.rechazado'));
      $pago->estat_pag        = config('app.pendiente');
      //  $pago->estat_pag        = $request->estatus_pago;
      $pago->form_de_pag      = $request->forma_de_pago;
      $pago->mont_de_pag      = $request->monto_del_pago;
      $pago->coment_pag_vent  = $request->comentarios_ventas;

      if($pago->form_de_pag != 'Efectivo (Jonathan)' AND $pago->form_de_pag != 'Efectivo (Gabriel)' AND $pago->form_de_pag != 'Efectivo (Fernando)' AND  $pago->form_de_pag != 'Efectivo (Muestras/Garantías)') {
        $pago->fol            = $request->ultimos_8_digitos_del_folio_de_pago;
      } else {
        $pago->fol            = null;
      }
    
      if($pago->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Pagos (F. por pedido)', // Módulo
          'pago.fPedido.show', // Nombre de la ruta
          $id_pago, // Id del registro debe ir encriptado
          $pago->cod_fact, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Estatus pago', 'Forma de pago', 'Últimos 8 dígitos del folio de pago', 'Monto del pago', 'Comentarios ventas'), // Nombre de los inputs del formulario
          $pago, // Request
          array('estat_pag', 'form_de_pag', 'fol', 'mont_de_pag', 'coment_pag_vent') // Nombre de los campos en la BD
        ); 
        $pago->updated_at_pag  = Auth::user()->email_registro;
      }  
      // ELIMINA LA COPIA DE IDENTIFICACION EN CASO DE QUE LA FORMA DE PAGO SE MODIFIQUE
      if($pago->isDirty('form_de_pag')) {
        ArchivosEliminados::dispatch(
          $ruta_nombre = array($pago->cop_de_indent_nom), 
        );
        $pago->cop_de_indent_rut  = null;
        $pago->cop_de_indent_nom  = null;
      }
      if($request->hasfile('comprobante_de_pago')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('comprobante_de_pago'), // Archivo blob
          'pedidos/'.date("Y").'/'.$pago->pedido->num_pedido, // Ruta en la que guardara el archivo
          'comprobante_de_pago-'.time().'.', // Nombre del archivo
          $pago->comp_de_pag_nom // Ruta y nombre del archivo anterior
        ); 
        $pago->comp_de_pag_rut  = $imagen[0]['ruta'];
        $pago->comp_de_pag_nom  = $imagen[0]['nombre'];
      }
      if($request->hasfile('copia_de_identificacion')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('copia_de_identificacion'), // Archivo blob
          'pedidos/'.date("Y").'/'.$pago->pedido->num_pedido, // Ruta en la que guardara el archivo
          'copia_de_identificacion-'.time().'.', // Nombre del archivo
          $pago->cop_de_indent_nom // Ruta y nombre del archivo anterior
        ); 
        $pago->cop_de_indent_rut  = $imagen[0]['ruta'];
        $pago->cop_de_indent_nom  = $imagen[0]['nombre'];
      }
      $pago->save();
      $this->pedidoActivoRepo->getEstatusPagoPedido($pago->pedido);

      DB::commit();
      return $pago;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_pago) {
    try { DB::beginTransaction();
      $pago = $this->getPagoFindOrFailById($id_pago, ['pedido', 'factura'], null);
      $pago->forceDelete();
      $this->pedidoActivoRepo->getEstatusPagoPedido($pago->pedido);

      // IMPORTANTE NO SE IMPLEMENTARA PAPELERA DE RECICLAJE (POR LOS MONTOS DE LOS PAGOS RELACIONADOS AL PEDIDO)

      // ELIMINA LOS ARCHIVOS DEL PAGO
      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      ArchivosEliminados::dispatch([
        $pago->comp_de_pag_nom,
        $pago->cop_de_indent_nom
      ]);

      // ELIMINA LOS ARCHIVOS DE LA COTIZACION RELACIONADA AL PAGO
      if(empty($pago->factura) == FALSE) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ArchivosEliminados::dispatch([
          $pago->factura->fact_pdf_nom,
          $pago->factura->fact_xlm_nom,
          $pago->factura->ppd_pdf_nom,
          $pago->factura->ppd_xlm_nom
        ]);
      }
  
      DB::commit();
      return $pago;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function marcarComoFacturado($id_pago) {
    try { DB::beginTransaction();
      $pago = $this->getPagoFindOrFailById($id_pago, [], null);
      if($pago->est_fact != config('app.no_solicitada') AND $pago->est_fact != config('app.cancelado')) {
        return abort(403, 'El pago esta en proceso de facturación o ya fue facturado.');
      }

      $pago->est_fact = config('app.facturado_por_fuera');      
      if($pago->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Pagos (Individual)', // Módulo
          'pago.show', // Nombre de la ruta
          $id_pago, // Id del registro debe ir encriptado
          $pago->cod_fact, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Estatus factura'), // Nombre de los inputs del formulario
          $pago, // Request
          array('est_fact') // Nombre de los campos en la BD
        ); 
        $pago->updated_at_pag  = Auth::user()->email_registro;
      }
      $pago->save(); 
      
      DB::commit();
      return $pago;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function generateRandomString($length = 4) { 
    return substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
  }
  public function getMontoDePagosAprobados($pedido) {
    return $this->pedidoActivoRepo->getMontoDePagosAprobados($pedido);
  }
  public function modificarEstatusProduccionYAlmacen($pedido) {
    if($pedido->estat_alm == config('app.pendiente')) {
      $pedido->estat_alm          = config('app.en_revision_de_productos');
      $pedido->fech_estat_alm     = date("Y-m-d h:i:s"); 

      $pedido->estat_produc       = config('app.asignar_lider_de_pedido');
      $pedido->fech_estat_produc  = date("Y-m-d h:i:s");
      $pedido->save();

      // CAMBIA EL ESTATUS DE LOS ARMADOS DEL PEDIDO PARA QUE ALMACÉN LOS PUEDA MODIFICAR
      $up_estat = NULL;
      $ids      = NULL;
      foreach($pedido->armados as $armado){ 
        $up_estat .= ' WHEN '. $armado->id. ' THEN "'. config('app.en_espera_de_compra').'"';
        $ids      .= $armado->id.',';
      }
      if($up_estat != null) {
        $nom_tabla = (new \App\Models\PedidoArmado())->getTable();
        $ids = substr($ids, 0, -1);
        DB::UPDATE("UPDATE ".$nom_tabla." SET estat = CASE id". $up_estat." END WHERE id IN (".$ids.")");
      }
    }
  }
  public function getPagoForCodigoFacturacionFindOrFail($codigo_de_facturacion, $relaciones) {
    return Pago::with($relaciones)->where('cod_fact', $codigo_de_facturacion)->firstOrFail();
  }
  public function cambiarEstatusFacturaDelPago($pago, $estatus) {
    $pago->est_fact = $estatus;
    $pago->save();
  }

}