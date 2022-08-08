<?php
namespace App\Repositories\produccion\pedidoActivo;
// Models
use App\Models\Pedido;
use App\Models\PedidoArmado;
// Events
use App\Events\layouts\ActividadRegistrada;
// repositories
use App\Repositories\logistica\direccionLocal\DireccionLocalRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;


class PedidoActivoRepositories implements PedidoActivoInterface {
  protected $serviceCrypt;
  protected $direccionLocalRepo;
  public function __construct(ServiceCrypt $serviceCrypt, DireccionLocalRepositories $direccionLocalRepositories) {
    $this->serviceCrypt = $serviceCrypt;
    $this->direccionLocalRepo = $direccionLocalRepositories;
  }
  public function getPagination($request, $relaciones, $opc_consulta) {
    if($request->paginador == null) {
      $paginador = 50;
    }else {
      $paginador = $request->paginador;
    }
    return Pedido::pendientesPedido($opc_consulta)
      ->with($relaciones)
      ->where('estat_produc', '!=', config('app.en_almacen_de_salida_terminado'))
      /*
      ->where(function ($query) {
        $query->where('estat_produc', config('app.asignar_lider_de_pedido'))
        ->orWhere('estat_produc', config('app.en_espera_de_almacen'))
        ->orWhere('estat_produc', config('app.productos_completos'))
        ->orWhere('estat_produc', config('app.en_produccion'));
      })
      */
      ->buscar($request->opcion_buscador, $request->buscador)
      ->orderBy('fech_estat_produc', 'DESC')
      ->paginate($paginador);
  }
  public function pedidoActivoProduccionFindOrFailById($id_pedido, $relaciones, $accion) {
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    $consulta = Pedido::with($relaciones);
    
    if($accion == 'edit') {
      $consulta->where(function ($query) {
        $query->where('estat_produc', config('app.asignar_lider_de_pedido'))
          ->orWhere('estat_produc', config('app.en_espera_de_almacen'))
          ->orWhere('estat_produc', config('app.productos_completos'))
          ->orWhere('estat_produc', config('app.en_produccion'));
      });
    }
   
    return $consulta->findOrFail($id_pedido);
  }
  public function update($request, $id_pedido) {
    try { DB::beginTransaction();
      $pedido                    = $this->pedidoActivoProduccionFindOrFailById($id_pedido, [], 'edit');

      if($request['lider_de_pedido_produccion'] != null|| $request['lider_de_pedido_produccion'] != ''){
        $pedido->lid_de_ped_produc = $request['lider_de_pedido_produccion'];
      }else{
        $pedido->lid_de_ped_produc = 'sin lider';
      }
      $pedido->bod               = $request->bodega_donde_se_armara;
      $pedido->coment_produc     = $request->comentario_produccion;
      if($pedido->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Producción (Pedidos activos)', // Módulo
          'produccion.pedidoActivo.show', // Nombre de la ruta
          $id_pedido, // Id del registro debe ir encriptado
          $pedido->num_pedido, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Líder de pedido producción', 'Bodega donde se armara', 'Comentario producción'), // Nombre de los inputs del formulario
          $pedido, // Request
          array('lid_de_ped_produc', 'bod', 'coment_produc') // Nombre de los campos en la BD
        );
        $pedido->updated_at_ped = Auth::user()->email_registro;
      }
      $pedido->save();
      Pedido::getEstatusPedido($pedido, 'Todos');

      DB::commit();
      return $pedido;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getArmadosPedidoPaginate($pedido, $request) {
    if($pedido->lid_de_ped_produc != null) {
      if($request->opcion_buscador != null) {
        return $pedido->armados()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
      }
      return $pedido->armados()->paginate($request->paginador);
    }
    return $pedido->armados()->where('id', '!"#$%&/()(/&%$')->paginate($request->paginador);
  }
  public function getPendientes() {
    $fecha = date("Y-m-d");
    $mas_dia = date("Y-m-d", strtotime('+3 day', strtotime(date("Y-m-d"))));
    $menos_un_dia = date("Y-m-d", strtotime('-1 day', strtotime(date("Y-m-d"))));
    $menos_dia = date("Y-m-d", strtotime('-5 day', strtotime(date("Y-m-d"))));
    $nom_tabla = (new \App\Models\Pedido())->getTable();
    
    $consulta = DB::table('pedidos')->select(
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_produc = '".config('app.asignar_lider_de_pedido')."' OR estat_produc = '".config('app.en_espera_de_almacen')."' OR estat_produc = '".config('app.productos_completos')."' OR estat_produc = '".config('app.en_produccion')."') AND (fech_de_entreg BETWEEN '$fecha' AND '$mas_dia')) as porEntregar"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_produc = '".config('app.asignar_lider_de_pedido')."' OR estat_produc = '".config('app.en_espera_de_almacen')."' OR estat_produc = '".config('app.productos_completos')."' OR estat_produc = '".config('app.en_produccion')."') AND (fech_de_entreg BETWEEN '$menos_dia' AND '$menos_un_dia')) as yaCaducados"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_produc = '".config('app.asignar_lider_de_pedido')."' OR estat_produc = '".config('app.en_espera_de_almacen')."' OR estat_produc = '".config('app.productos_completos')."' OR estat_produc = '".config('app.en_produccion')."') AND (estat_pag != '".config('app.pagado')."')) as pteDePago"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_produc = '".config('app.asignar_lider_de_pedido')."' OR estat_produc = '".config('app.en_espera_de_almacen')."' OR estat_produc = '".config('app.productos_completos')."' OR estat_produc = '".config('app.en_produccion')."') AND (estat_pag = '".config('app.pago_rechazado')."')) as pagoRechazado"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_produc = '".config('app.asignar_lider_de_pedido')."' OR estat_produc = '".config('app.en_espera_de_almacen')."' OR estat_produc = '".config('app.productos_completos')."' OR estat_produc = '".config('app.en_produccion')."') AND (urg = '".config('opcionesSelect.es_pedido_urgente.Si')."')) as urgente")
    )->first();
    if($consulta == null) { 
      $consulta = (object) array('porEntregar' => 0, 'yaCaducados' => 0, 'pteDePago' => 0, 'pagoRechazado' => 0, 'urgente' => 0);
    }

    return $consulta; 
  }

  public function asignarRackArmados($request, $id_pedido) {
    try { DB::beginTransaction();
      $pedido = $this->pedidoActivoProduccionFindOrFailById($id_pedido, ['armados'], 'edit');
      $armados = $pedido->armados()->where('estat', config('app.productos_completos'))->orWhere('estat', config('app.en_produccion'))->get();
      
      $cantArmados = count($armados);
      $rack = $request->ubicacion_rack;
      $estatus          = config('app.en_almacen_de_salida');
      
      $nom_tabla = (new PedidoArmado())->getTable();
      $ubic_rack = NULL;
      $estat  = NULL;
      $updated_at_ped_arm = NULL;
      $ids_arms = NULL;
      
      foreach($armados as $armado){
        $ubic_rack  .= ' WHEN '. $armado->id. ' THEN "'. $rack.'"';
        $estat  .= ' WHEN '. $armado->id. ' THEN "'. $estatus.'"';
        $updated_at_ped_arm   .=  ' WHEN '. $armado->id. ' THEN "'. Auth::user()->email_registro.'"';
        $ids_arms        .= $armado->id.',';
      }
      
      if($cantArmados > 0) {
        $ids_arms = substr($ids_arms, 0, -1);
        DB::UPDATE("UPDATE ".$nom_tabla." SET ubic_rack = CASE id". $ubic_rack." END,  estat = CASE id". $estat." END, updated_at_ped_arm = CASE id". $updated_at_ped_arm." END WHERE id IN (".$ids_arms.")");
      }

      foreach($armados as $armado){
        $this->direccionLocalRepo->cambiarEstatusDireccionAlmacenDeSalida($armado->direcciones);
      }
    
      if($pedido->fech_estat_log == null) {
        $pedido->fech_estat_log = date("Y-m-d h:i:s");
      }

      $pedido->save();
      Pedido::getEstatusPedido($pedido, 'Todos');
      DB::commit();
      return $pedido;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }

// obtener los pedidos que coinciden con la fehca actual
  // public function countFechaEntrega(){
  //   $pedido_date = Carbon::now();
  //   contar el numero de pedidos y obtener la fecha de produccion
  //   $pedido_date = Pedido::whereDate('fech_de_entreg', '=', Carbon::now()->format('Y-m-d'))->count();

  //   return ($pedido_date);
  // }

}