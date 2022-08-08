<?php
namespace App\Http\Controllers\RolCliente\Pedido\Armado\Direccion;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\rolCliente\pedido\armado\direccion\UpdateDireccionRequest;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
use App\Events\layouts\ArchivosEliminados;
// Models
use App\Models\PedidoArmadoTieneDireccion;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\venta\pedidoActivo\armadoPedidoActivo\direccion\DireccionArmadoRepositories;
use App\Repositories\rolCliente\direccion\DireccionRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class DireccionController extends Controller {
  protected $serviceCrypt;
  protected $direccionArmadoRepo;
  protected $direccionRepo;
  public function __construct(ServiceCrypt $serviceCrypt, DireccionArmadoRepositories $direccionArmadoRepositories, DireccionRepositories $direccionRepositories) {
    $this->serviceCrypt        = $serviceCrypt;
    $this->direccionArmadoRepo = $direccionArmadoRepositories;
    $this->direccionRepo       = $direccionRepositories;
  }
  public function show($id_direccion) {
    $id_direccion = $this->serviceCrypt->decrypt($id_direccion);
    $direccion    = PedidoArmadoTieneDireccion::with(['comprobantes', 'armado'])->findOrFail($id_direccion);
    $comprobantes = $direccion->comprobantes;
    return view('rolCliente.pedido.armado.direccion.dir_show', compact('comprobantes', 'direccion'));
  }
  public function edit($id_direccion) {
    $id_direccion = $this->serviceCrypt->decrypt($id_direccion);
    $direccion = PedidoArmadoTieneDireccion::with(['armado'])->findOrFail($id_direccion);

    // Aborta si el armado que pertene al pedido no es del cliente 
    if($direccion->armado->pedido->user_id != Auth::user()->id OR $direccion->nom_ref_uno != null) {
    abort('404');
    }

    $direcciones = $this->direccionRepo->getDireccionesClientePluck();
    return view('rolCliente.pedido.armado.direccion.dir_edit', compact('direccion', 'direcciones'));
  }
  public function update(UpdateDireccionRequest $request, $id_direccion) {
    // VALIDAR QUE SOLO PUEDA MODIFICAR SI EL NOMBRE DE LA PERSONA QUE RECIBE ES NULL
    try { DB::beginTransaction();
      $direccion = $this->direccionArmadoRepo->direccionFindOrFailById($id_direccion, ['armado']);
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
      $direccion->pais                = $request->pais;

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

      if($request->tipo_de_tarjeta_de_felicitacion != NULL) {
        $direccion->tip_tarj_felic  = $request->tipo_de_tarjeta_de_felicitacion;
      }
      
      if($direccion->tip_tarj_felic ==  config('opcionesSelect.select_tarjeta_de_felicitacion.Personalizada')) {
        $direccion->mens_dedic      = $request->mensaje_de_dedicatoria;
      } else {
        $direccion->mens_dedic = null;
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
          array('Tipo de tarjeta de felicitación', 'Mensaje de dedicatoria', 'Nombre de la persona que recibe uno', 'Nombre de la persona que recibe dos', 'Lada teléfono fijo', 'Teléfono fijo', 'Extensión', 'Lada teléfono móvil', 'Teléfono móvil', 'Calle ', 'No. Exterior', 'No. Interior', 'País', 'Ciudad', 'Colonia', 'Delegación o municipio', 'Código postal', 'Referencias zona de entrega'), // Nombre de los inputs del formulario
          $direccion, // Request
          array('tip_tarj_felic', 'mens_dedic', 'nom_ref_uno', 'nom_ref_dos', 'lad_fij', 'tel_fij', 'ext', 'lad_mov', 'tel_mov', 'calle', 'no_ext', 'no_int', 'pais', 'ciudad', 'col', 'del_o_munic', 'cod_post', 'ref_zon_de_entreg') // Nombre de los campos en la BD
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

      $direccion->save();
      if($se_modifico == 'Si') {
        $this->direccionArmadoRepo->estatusDireccionesDetalladas($direccion->cant, $direccion->armado, $ya_cargado);
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
    } catch(\Exception $e) { DB::rollback(); throw $e; }
    
    toastr()->success('¡Dirección actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    $pedido = $direccion->armado->pedido;
    if($pedido->estat_vent_gen == config('app.informacion_general_completa') AND $pedido->estat_vent_arm == config('app.armados_cargados') AND $pedido->estat_vent_dir == config('app.direccion_de_armados_asignado')) {
      toastr()->success('¡Pedido detallado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return redirect(route('rolCliente.pedido.index'));
    }
    return redirect(route('rolCliente.pedido.edit', $this->serviceCrypt->encrypt($direccion->armado->pedido_id)));
  }
}