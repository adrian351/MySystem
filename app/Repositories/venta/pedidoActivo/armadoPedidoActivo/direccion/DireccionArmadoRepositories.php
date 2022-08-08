<?php
namespace App\Repositories\venta\pedidoActivo\armadoPedidoActivo\direccion;
// Models
use App\Models\PedidoArmadoTieneDireccion;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
use App\Events\layouts\ArchivosEliminados;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\rolCliente\direccion\DireccionRepositories;
// use App\Repositories\venta\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class DireccionArmadoRepositories implements DireccionInterface {
  protected $serviceCrypt;
  protected $direccionRepo;
  // protected $armadoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, DireccionRepositories $direccionRepositories) {
    $this->serviceCrypt   = $serviceCrypt;
    $this->direccionRepo  = $direccionRepositories;
    // $this->armadoRepo     = $armadoPedidoActivoRepositories;
  } 
  public function direccionFindOrFailById($id_direccion, $relaciones) { // 'productos', 'direcciones', 'pedido'
    $id_direccion = $this->serviceCrypt->decrypt($id_direccion);
    $direccion = PedidoArmadoTieneDireccion::with($relaciones)->findOrFail($id_direccion);
    return $direccion;
  }
  public function update($request, $id_direccion) {
    try { DB::beginTransaction();
      $direccion = $this->direccionFindOrFailById($id_direccion, ['armado']);
      $nom_ref_uno_orig               = $direccion->nom_ref_uno;
      $direccion->nom_ref_uno         = $request->nombre_de_la_persona_que_recibe_uno;
      $direccion->nom_ref_dos         = $request->nombre_de_la_persona_que_recibe_dos;
      $direccion->lad_fij             = $request->lada_telefono_fijo;
      $direccion->tel_fij             = $request->telefono_fijo;
      $direccion->ext                 = $request->extension;
      $direccion->lad_mov             = $request->lada_telefono_movil;
      $direccion->tel_mov             = $request->telefono_movil;
      $direccion->calle               = $request->calle;
      $direccion->no_ext              = $request->no_exterior;
      $direccion->no_int              = $request->no_interior;
      $direccion->pais                = 'México';
      if($direccion->est == 'Tarifa única ') {
        $direccion->ciudad              = $request->ciudad;
      } else {
        $direccion->ciudad              = $direccion->est;
      }

      $direccion->col                 = $request->colonia;
      $direccion->del_o_munic         = $request->delegacion_o_municipio;
      $direccion->cod_post            = $request->codigo_postal;
      $direccion->ref_zon_de_entreg   = $request->referencias_zona_de_entrega;

      $ya_cargado = 'No';
      if($nom_ref_uno_orig != null) {
        $ya_cargado = 'Si';
      }

      $se_modifico = null;
      if($direccion->isDirty()) {
        $se_modifico = 'Si';
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Ventas/Pedido Activo/Armado (direcciones)', // Módulo
          'venta.pedidoActivo.armado.direccion.show', // Nombre de la ruta
          $id_direccion, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_direccion), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Nombre de la persona que recibe uno', 'Nombre de la persona que recibe dos', 'Lada teléfono fijo', 'Teléfono fijo', 'Extensión', 'Lada teléfono móvil', 'Teléfono móvil', 'Calle ', 'No. Exterior', 'No. Interior', 'País', 'Ciudad', 'Colonia', 'Delegación o municipio', 'Código postal', 'Referencias zona de entrega'), // Nombre de los inputs del formulario
          $direccion, // Request
          array('nom_ref_uno', 'nom_ref_dos', 'lad_fij', 'tel_fij', 'ext', 'lad_mov', 'tel_mov', 'calle', 'no_ext', 'no_int', 'pais', 'ciudad', 'col', 'del_o_munic', 'cod_post', 'ref_zon_de_entreg') // Nombre de los campos en la BD
        ); 
        $direccion->updated_at_direc_arm  = Auth::user()->email_registro;
      }

      $direccion->save();
      if($se_modifico == 'Si') {
        $this->estatusDireccionesDetalladas($direccion->cant, $direccion->armado, $ya_cargado);
      }
     
      // REGISTRA LA DIRECCION AL PERFIN DEL USUARIO SI EL CHECK ESTA ACTIVADO
      if($request->checkbox_direccion == 'on') {
        $reg_direccion = new \App\Models\Direccion();
        $this->direccionRepo->storeFields($reg_direccion, $request);
        $reg_direccion->user_id             = $direccion->armado->pedido->user_id;
        $reg_direccion->created_at_direc    = Auth::user()->email_registro; 
        $reg_direccion->save();
      }
      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function updateTarjeta($request, $id_direccion) {
    // dd($request);
    try { DB::beginTransaction();
      $direccion = $this->direccionFindOrFailById($id_direccion, ['armado']);
   
      if($request->tipo_de_tarjeta_de_felicitacion != NULL) {
        $direccion->tip_tarj_felic  = $request->tipo_de_tarjeta_de_felicitacion;
      }
      
      if($direccion->tip_tarj_felic ==  config('opcionesSelect.select_tarjeta_de_felicitacion.Personalizada')) {
        $direccion->mens_dedic      = $request->mensaje_de_dedicatoria;
      } else {
        $direccion->mens_dedic = null;
      }

      if($direccion->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Ventas/Pedido Activo/Armado (direcciones)', // Módulo
          'venta.pedidoActivo.armado.direccion.show', // Nombre de la ruta
          $id_direccion, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_direccion), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Tipo de tarjeta de felicitación', 'Mensaje de dedicatoria'), // Nombre de los inputs del formulario
          $direccion, // Request
          array('tip_tarj_felic', 'mens_dedic') // Nombre de los campos en la BD
        ); 
        $direccion->updated_at_direc_arm  = Auth::user()->email_registro;
      }

      // Elimina la tarjeta diseñada por el cliente en caso de que el tipo de tarjeta de felicitacion cambie
      if($direccion->isDirty('tip_tarj_felic')) {
        ArchivosEliminados::dispatch(array($direccion->tarj_dise_rut.$direccion->tarj_dise_nom));
        $direccion->tarj_dise_rut   = null;
        $direccion->tarj_dise_nom   = null;
      }
      
      if($direccion->tip_tarj_felic == config('opcionesSelect.select_tarjeta_de_felicitacion.Diseñada por el cliente')) {
        if($request->hasfile('tarjeta_disenada_por_el_cliente')) {
          // Dispara el evento registrado en App\Providers\EventServiceProvider.php
          $imagen = ArchivoCargado::dispatch(
            $request->file('tarjeta_disenada_por_el_cliente'), // Archivo blob
            'pedidos/'.date("Y").'/tarjetas_diseñadas_por_el_cliente', // Ruta en la que guardara el archivo
            'tarjeta_diseñadas_por_el_cliente-'.time().'.', // Nombre del archivo
            $direccion->tarj_dise_nom // Ruta y nombre del archivo anterior
          ); 
          $direccion->tarj_dise_rut  = $imagen[0]['ruta'];
          $direccion->tarj_dise_nom  = $imagen[0]['nombre'];
        }
      }

      // if($direccion->tip_tarj_felic != config('opcionesSelect.select_tarjeta_de_felicitacion.Diseñada por el cliente')) {
        if($request->hasfile('imagen_de_la_tarjeta')) {
          $imagen_blob = request()->file('imagen_de_la_tarjeta');
          // Dispara el evento registrado en App\Providers\EventServiceProvider.php
          $imagen = ArchivoCargado::dispatch(
            $imagen_blob, // Archivo blob
            'pedidos/'.date("Y").'/imagenes', // Ruta en la que guardara el archivo
            'imagen_de_la_tarjeta-'.time().'.', // Nombre del archivo
              $direccion->tarj_dise_nom // Ruta y nombre del archivo anterior
          ); 
          $direccion->tarj_dise_rut  = $imagen[0]['ruta'];
          $direccion->tarj_dise_nom  = $imagen[0]['nombre'];
        }
      // }
      $direccion->save();

      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  //funcionalidad no habilitada en fron por su dudosa funcionalidad 
  // public function updateCantidad($request, $id_direccion, $id_armado) {
  //   try { DB::beginTransaction();
  //     $direccion = $this->direccionFindOrFailById($id_direccion, ['armado']);
  //     // request
  //     $direccion->cant = $request->cantidad_por_direccion;
  //     // nuevo valor
  //     $cantEntrada = (int)$direccion->cant;
  //     // valor original que se editará
  //     $valorOriginal = $direccion->getOriginal('cant');
  //     // valor total
  //     $sumaTotal = 0;
  //     // obtener el armado y sus cantidades para hacer la accion.
  //     $armado = $this->armadoRepo->armadoFindOrFailById($id_armado, []); 
  //     $sumaDireccionesArmado = 0;
      
  //     foreach($armado->direcciones as $sumDirecciones){
  //       $sumaDireccionesArmado += $sumDirecciones->cant;
  //     }
      
  //     $restaValorOriginal = $sumaDireccionesArmado - $valorOriginal;
  //     $sumaTotal = $restaValorOriginal + $cantEntrada;

  //     if($sumaTotal > $armado->cant){
  //       return false;
  //     }

  //     if($direccion->isDirty()) {
  //       // Dispara el evento registrado en App\Providers\EventServiceProvider.php
  //       ActividadRegistrada::dispatch(
  //         'Ventas/Pedido Activo/Armado (direcciones)', // Módulo
  //         'venta.pedidoActivo.armado.direccion.show', // Nombre de la ruta
  //         $id_direccion, // Id del registro debe ir encriptado
  //         $this->serviceCrypt->decrypt($id_direccion), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
  //         array('cantidad_por_direccion'), // Nombre de los inputs del formulario
  //         $direccion, // Request
  //         array('cant') // Nombre de los campos en la BD
  //       ); 
  //       $direccion->updated_at_direc_arm  = Auth::user()->email_registro;
  //     }

  //     $direccion->save();

  //     DB::commit();
  //     return $direccion;
  //   } catch(\Exception $e) { DB::rollback(); throw $e; }
  // }

  public function estatusDireccionesDetalladas($cant_direccion, $armado, $ya_se_habia_cargado) {
    if($armado->cant != $armado->cant_direc_carg) {
      if($ya_se_habia_cargado == 'No') {
        $armado->cant_direc_carg += $cant_direccion;
        $armado->save();
      }
      \App\Models\Pedido::getEstatusVentas($armado->pedido);
    }
  }

  // public function destroy($id_direccion) {
  //   try { DB::beginTransaction();
  //     $direccion = $this->direccionFindOrFailById($id_direccion, ['armado']);
      
      
  //     $direccion->delete();
  //     DB::commit();
  //     return $direccion;
  //   } catch(\Exception $e) { DB::rollback(); throw $e; }
  // }
}