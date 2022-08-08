<?php
namespace App\Repositories\factura;
// Models
use App\Models\Factura;
// Notifications
use App\Notifications\factura\NotificacionFacturaGenerada;
use App\Notifications\factura\NotificacionFacturaCancelada;
use App\Notifications\factura\NotificacionFacturaErrorDelCliente;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\pago\PagoRepositories;
use App\Repositories\sistema\plantilla\PlantillaRepositories;
use App\Repositories\sistema\sistema\SistemaRepositories;
use App\Repositories\rolCliente\datoFiscal\DatoFiscalRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class FacturaRepositories implements FacturaInterface {
  protected $serviceCrypt;
  protected $pagoRepo;
  protected $plantillaRepo;
  protected $sistemaRepo;
  protected $datoFiscalRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PagoRepositories $pagoRepositories, PlantillaRepositories $plantillaRepositories, SistemaRepositories $sistemaRepositories, DatoFiscalRepositories $datoFiscalRepositories) {
    $this->serviceCrypt   = $serviceCrypt;
    $this->pagoRepo       = $pagoRepositories;
    $this->plantillaRepo  = $plantillaRepositories;
    $this->sistemaRepo    = $sistemaRepositories;
    $this->datoFiscalRepo = $datoFiscalRepositories;
  }
  public function getFacturaFindOrFailById($id_factura, $relaciones, $estatus) {
    $id_factura = $this->serviceCrypt->decrypt($id_factura);
    return Factura::with($relaciones)->estatus($estatus)->findOrFail($id_factura);
  }
  public function getPagination($request) {
    return Factura::with(['usuario', 'pago' => function($query) {
      $query->with('pedido');
    }])->buscar($request->opcion_buscador, $request->buscador)->orderByRaw('est_fact DESC, id DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try { DB::beginTransaction();
      $pago = $this->pagoRepo->getPagoForCodigoFacturacionFindOrFail($request->codigo_de_facturacion, []);

      $factura = new Factura();
      $factura = $this->storeFields($factura, $request);
      $factura->pago_id         = $pago->id;
      $factura->user_id         = $request->cliente;
      $factura->created_at_fact = Auth::user()->email_registro;
      $factura->save();

      /*
      * Cambia el estatus de la factura del pago a Pendiente
      */
      $this->pagoRepo->cambiarEstatusFacturaDelPago($pago, config('app.pendiente'));

      // GUARDA LOS DATOS FISCALES AL PERFIN EL USUARIO SI SE MARCA EL CHECKBOX 
      if($request->checkbox_datos_fiscales == 'on') {
        $dato_fiscal                      = new \App\Models\DatoFiscal();
        $dato_fiscal                      = $this->datoFiscalRepo->storeFields($dato_fiscal, $request);
        $dato_fiscal->user_id             = $request->cliente;
        $dato_fiscal->created_at_dat_fisc = $request->cliente; //dsgfsfsdgsdfsdgfdggsfg FALTA CORREGIR ESTE
        $dato_fiscal->save();
      }

      DB::commit();
      return $factura;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function storeFields($factura, $request) {
    $factura->nom_o_raz_soc = $request->nombre_o_razon_social;
    $factura->rfc           = $request->rfc;
    $factura->lad_fij       = $request->lada_telefono_fijo;
    $factura->tel_fij       = $request->telefono_fijo;
    $factura->ext           = $request->extension;
    $factura->lad_mov       = $request->lada_telefono_movil;
    $factura->tel_mov       = $request->telefono_movil;
    $factura->calle         = $request->calle;
    $factura->no_ext        = $request->no_exterior;
    $factura->no_int        = $request->no_interior;
    $factura->pais          = $request->pais;
    $factura->ciudad        = $request->ciudad;
    $factura->col           = $request->colonia;
    $factura->del_o_munic   = $request->delegacion_o_municipio;
    $factura->cod_post      = $request->codigo_postal;
    $factura->corr          = $request->correo;
    $factura->uso_de_cfdi                     = $request->uso_de_cfdi;
    $factura->met_de_pag                      = $request->metodo_de_pago;
    $factura->form_de_pag                     = $request->forma_de_pago;
    $factura->banc_de_cuent_de_retir          = $request->banco_de_cuenta_de_retiro;
    $factura->ulti_cuatro_dig_cuent_de_retir  = $request->ultimos_4_digitos_cuenta_de_retiro;
    $factura->concept                         = $request->concepto;
    $factura->coment_u_obs_us                 = $request->comentarios_cliente;
    return $factura;
  }
  public function update($request, $id_factura) {
    try { DB::beginTransaction();
      $factura = $this->getFacturaFindOrFailById($id_factura, ['usuario', 'pago'], config('app.facturado'));
      $factura->est_fact      = $request->estatus_factura;
      $factura->coment_admin  = $request->comentarios;

      if($factura->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Facturación', // Módulo
          'factura.show', // Nombre de la ruta
          $id_factura, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_factura), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Estatus factura', 'Comentarios',), // Nombre de los inputs del formulario
          $factura, // Request
          array('est_fact', 'coment_admin') // Nombre de los campos en la BD
        ); 
        $factura->updated_at_fact = Auth::user()->email_registro;
      }

      if($factura->isDirty()) {
        // ENVIA UN CORREO AL CLIENTE DE QUE SU FACTURA TIENE UN ERROR
        $plantilla = $this->plantillaRepo->plantillaFindOrFailById($this->sistemaRepo->datos('plant_fac_err_cli'));
        $factura->usuario->notify(new NotificacionFacturaErrorDelCliente($factura->usuario, $plantilla, $factura)); // Envió de correo electrónico
      }

      $factura->save();

      /*
      * Cambia el estatus de la factura del pago a Facturado
      */
      $this->pagoRepo->cambiarEstatusFacturaDelPago($factura->pago, config('app.error_del_cliente'));

      DB::commit();
      return $factura;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_factura) {
    try { DB::beginTransaction();
      $factura = $this->getFacturaFindOrFailById($id_factura, ['usuario', 'pago'], []);
      $factura->forceDelete();
     
      /*
      * Cambia el estatus de la factura del pago a Pendiente
      */
      if($factura->est_fact == config('app.pendiente') OR $factura->est_fact == config('app.error_del_cliente')) {
        $estatus = config('app.cancelado');
      } elseif($factura->est_fact == config('app.facturado')) {
        $estatus = config('app.facturado_eliminado');
      }
      $this->pagoRepo->cambiarEstatusFacturaDelPago($factura->pago, $estatus);
      
      // ENVIA UN CORREO AL CLIENTE DE QUE SU FACTURA HA SIDO CANCELADA
      $plantilla = $this->plantillaRepo->plantillaFindOrFailById($this->sistemaRepo->datos('plant_fac_cancelado'));
      $factura->usuario->notify(new NotificacionFacturaCancelada($factura->usuario, $plantilla, $factura)); // Envió de correo electrónico
    
      DB::commit();
      return $factura;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function updateSubirArchivos($request, $id_factura) {
    try { DB::beginTransaction();

      // Verifica si se cargo algun archivo o no
      if($request->factura_pdf == NULL AND $request->factura_xlm == NULL AND $request->ppd_pdf == NULL AND $request->ppd_xlm == NULL) {
        return abort(403, 'No has seleccionado ningún archivo');
      }

      $factura = $this->getFacturaFindOrFailById($id_factura, ['usuario', 'pago'], null);
      $factura->est_fact = config('app.facturado');
      $factura->fech_facturado  = date('Y-m-d');
       
      if($request->hasfile('factura_pdf')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('factura_pdf'), // Archivo blob
          'facturas/'.date("Y").'/'.$factura->id, // Ruta en la que guardara el archivo
          'factura_pdf-' . time() . '.', // Nombre del archivo
          $factura->fact_pdf_nom // Ruta y nombre del archivo anterior
        ); 
        $factura->fact_pdf_rut  = $imagen[0]['ruta'];
        $factura->fact_pdf_nom  = $imagen[0]['nombre'];
      }
    
      if($request->hasfile('factura_xlm')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('factura_xlm'), // Archivo blob
          'facturas/'.date("Y").'/'.$factura->id, // Ruta en la que guardara el archivo
          'factura_xlm-' . time() . '.', // Nombre del archivo
          $factura->fact_xlm_nom // Ruta y nombre del archivo anterior
        ); 
        $factura->fact_xlm_rut  = $imagen[0]['ruta'];
        $factura->fact_xlm_nom  = $imagen[0]['nombre'];
      }

      if($request->hasfile('ppd_pdf')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('ppd_pdf'), // Archivo blob
          'facturas/'.date("Y").'/'.$factura->id, // Ruta en la que guardara el archivo
          'ppd_pdf-' . time() . '.', // Nombre del archivo
          $factura->ppd_pdf_nom // Ruta y nombre del archivo anterior
        ); 
        $factura->ppd_pdf_rut  = $imagen[0]['ruta'];
        $factura->ppd_pdf_nom  = $imagen[0]['nombre'];
      }

      if($request->hasfile('ppd_xlm')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('ppd_xlm'), // Archivo blob
          'facturas/'.date("Y").'/'.$factura->id, // Ruta en la que guardara el archivo
          'ppd_xlm-' . time() . '.', // Nombre del archivo
          $factura->ppd_xlm_nom // Ruta y nombre del archivo anterior
        ); 
        $factura->ppd_xlm_rut = $imagen[0]['ruta'];
        $factura->ppd_xlm_nom = $imagen[0]['nombre'];
      }
      
      if($factura->isDirty()) {
        // ENVIA UN CORREO AL CLIENTE DE QUE SU FACTURA HA SIDO GENERADA
        $plantilla = $this->plantillaRepo->plantillaFindOrFailById($this->sistemaRepo->datos('plant_fac_generada'));
        $factura->usuario->notify(new NotificacionFacturaGenerada($factura->usuario, $plantilla, $factura)); // Envió de correo electrónico
      }
      $factura->save();

      /*
      * Cambia el estatus de la factura del pago a Facturado
      */
      $this->pagoRepo->cambiarEstatusFacturaDelPago($factura->pago, config('app.facturado'));

      DB::commit();
      return $factura;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}