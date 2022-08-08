<?php
namespace App\Repositories\produccion\pedidoActivo\armadoPedidoActivo;
// Models
use App\Models\Pedido;
use App\Models\PedidoArmado;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\logistica\direccionLocal\DireccionLocalRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ArmadoPedidoActivoRepositories implements ArmadoPedidoActivoInterface {
  protected $serviceCrypt;
  protected $direccionLocalRepo;
  public function __construct(ServiceCrypt $serviceCrypt, DireccionLocalRepositories $direccionLocalRepositories) {
    $this->serviceCrypt = $serviceCrypt;
    $this->direccionLocalRepo = $direccionLocalRepositories;
  }
  public function armadoPedidoActivoFindOrFailById($id_armado, $relaciones, $accion) { // 'pedido'
    $id_armado = $this->serviceCrypt->decrypt($id_armado); 
    $consulta = PedidoArmado::with($relaciones);
    if($accion == 'edit') {
      $consulta->where(function ($query){
        $query->where('estat', config('app.productos_completos'))
          ->orWhere('estat', config('app.en_produccion'));
      });
    }
    return $consulta->findOrFail($id_armado);
  }
  public function update($request, $id_armado) {
    try { DB::beginTransaction();
      $armado                 = $this->armadoPedidoActivoFindOrFailById($id_armado, ['pedido', 'direcciones'], 'edit');
      $armado->estat          = $request->estatus;
      if($armado->estat == config('app.en_almacen_de_salida')) {
        // ubicacion de rack
        $armado->ubic_rack = $request->ubicacion_rack;

        //Cambia es estatus de las direcciones relacionadas a este armado
        $this->direccionLocalRepo->cambiarEstatusDireccionAlmacenDeSalida($armado->direcciones);

        // Se guarda la fecha en la que el pedido paso a logística por primera vez
        if($armado->pedido->fech_estat_log == null) {
          $armado->pedido->fech_estat_log = date("Y-m-d h:i:s");
          $armado->pedido->save();
        }
      }elseif($armado->estat == config('app.en_produccion') || $armado->estat == config('app.en_revision_de_productos') || $armado->estat == '') {
        $armado->ubic_rack = null; 
      }
      $armado->coment_produc  = $request->comentario_produccion;
      if($armado->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Producción/Pedidos activos (armado)', // Módulo
          'produccion.pedidoActivo.armado.show', // Nombre de la ruta
          $id_armado, // Id del registro debe ir encriptado
          $armado->cod, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Estatus', 'Ubicación rack', 'Comentario producción'), // Nombre de los inputs del formulario
          $armado, // Request
          array('estat', 'ubic_rack', 'coment_produc') // Nombre de los campos en la BD
        ); 
        $armado->updated_at_ped_arm = Auth::user()->email_registro;
      }
      $armado->save();

      Pedido::getEstatusPedido($armado->pedido, 'Todos');
      DB::commit();
      return $armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function armadosTerminadosProduccion($id_pedido, $estatus) {
    return Pedido::armadosTerminados($id_pedido, $estatus);
  }
  public function getArmadoPedidoTieneDireccionesPaginate($pedido, $request) {
    if($request->opcion_buscador != null) {
      return $pedido->direcciones()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $pedido->direcciones()->paginate($request->paginador);
  }
  public function updateModal($request, $id_armado) {
    try { DB::beginTransaction();
      $armado                 = $this->armadoPedidoActivoFindOrFailById($id_armado, ['pedido', 'direcciones'], 'edit');
      $armado->estat          = config('app.en_almacen_de_salida');
      $armado->ubic_rack      = $request->ubicacion_rack;
      // Se guarda la fecha en la que el pedido paso a logística por primera vez
      if($armado->pedido->fech_estat_log == null) {
        $armado->pedido->fech_estat_log = date("Y-m-d h:i:s");
        $armado->pedido->save();
      }
      //Cambia es estatus de las direcciones relacionadas a este armado
      $this->direccionLocalRepo->cambiarEstatusDireccionAlmacenDeSalida($armado->direcciones);
      
      if($armado->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Producción/Pedidos activos (armado)', // Módulo
          'produccion.pedidoActivo.armado.show', // Nombre de la ruta
          $id_armado, // Id del registro debe ir encriptado
          $armado->cod, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Estatus', 'Ubicación rack'), // Nombre de los inputs del formulario
          $armado, // Request
          array('estat', 'ubic_rack') // Nombre de los campos en la BD
        ); 
        $armado->updated_at_ped_arm = Auth::user()->email_registro;
      }
      $armado->save();
      Pedido::getEstatusPedido($armado->pedido, 'Todos');
      DB::commit();
      return $armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }

  public function estatusArmadoDireccion($pedido){
    $fecha = date('Y-m-d h:i:s');
    $up_fecha = null;
    $up_estaus     = NULL;
    $ids           = NULL;
    $nom_tabla = (new \App\Models\PedidoArmadoTieneDireccion)->getTable();

    foreach($pedido->armados as $armado){
      foreach($armado->direcciones as $direccion) {
        if($armado->es_de_stock == 'Si') {
          $up_estaus  .= ' WHEN '. $direccion->id. ' THEN "'. config('app.en_almacen_de_salida').'"';
          $up_fecha   .= ' WHEN '. $direccion->id. ' THEN "'.  $fecha.'"';
          $ids        .= $direccion->id.',';
        }
      }
    }
    if($up_estaus != NULL) {
      $ids = substr($ids, 0, -1);
      DB::UPDATE("UPDATE ".$nom_tabla." SET estat = CASE id". $up_estaus." END, fech_en_alm_salida = CASE id". $up_fecha." END WHERE id IN (".$ids.")");
    }
  }

  public function getEstatusArmado($id_pedido, $estatus) {
    return Pedido::armadosTerminados($id_pedido, $estatus);
  }
}