<?php
namespace App\Repositories\logistica\pedidoActivo;
// Models
use App\Models\Pedido;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class PedidoActivoRepositories implements PedidoActivoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function getPagination($request, $relaciones, $opc_consulta) {
    if($request->paginador == null) {
      $paginador = 50;
    }else {
      $paginador = $request->paginador;
    }

    return Pedido::pendientesPedido($opc_consulta)
    ->with($relaciones)
    ->Where('estat_log', '!=', config('app.entregado'))
/*
    ->where(function ($query) {
      $query->where('estat_log', config('app.en_espera_de_produccion'))
      ->orWhere('estat_log', config('app.en_almacen_de_salida'))
      ->orWhere('estat_log', config('app.en_ruta'))
      ->orWhere('estat_log', config('app.sin_entrega_por_falta_de_informacion'))
      ->orWhere('estat_log', config('app.intento_de_entrega_fallido'));
    })
*/
    ->buscar($request->opcion_buscador, $request->buscador)
    ->orderBy('fech_estat_log', 'DESC')
    ->paginate($paginador);
  }
  public function pedidoActivoLogisticaFindOrFailById($id_pedido, $relaciones) {
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    $pedido = Pedido::with($relaciones)->where(function ($query) {
      $query->where('estat_log', config('app.en_espera_de_produccion'))
        ->orWhere('estat_log', config('app.en_almacen_de_salida'))
        ->orWhere('estat_log', config('app.en_ruta'))
        ->orWhere('estat_log', config('app.sin_entrega_por_falta_de_informacion'))
        ->orWhere('estat_log', config('app.intento_de_entrega_fallido'));
      })->findOrFail($id_pedido);
    return $pedido;
  }
  public function update($request, $id_pedido) {
    DB::transaction(function() use($request, $id_pedido) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $pedido             = $this->pedidoActivoLogisticaFindOrFailById($id_pedido, []);
      $pedido->bod        = $request->bodega_donde_se_armara;
      $pedido->coment_log = $request->comentario_logistica;
      if($pedido->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Logística (Pedidos activos)', // Módulo
          'logistica.pedidoActivo.show', // Nombre de la ruta
          $id_pedido, // Id del registro debe ir encriptado
          $pedido->num_pedido, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Bodega donde se armara', 'Comentario logística'), // Nombre de los inputs del formulario
          $pedido, // Request
          array('bod', 'coment_log') // Nombre de los campos en la BD
        );
        $pedido->updated_at_ped = Auth::user()->email_registro;
      }
      $pedido->save();
      Pedido::getEstatusPedido($pedido, 'Todos');
      return $pedido;
    });
  }
  public function getArmadosPedidoPaginate($pedido, $request) {
    if($request->opcion_buscador != null) {
      return $pedido->armados()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $pedido->armados()->paginate($request->paginador);
  }
  public function getPendientes() {
    $fecha = date("Y-m-d");
    $mas_dia = date("Y-m-d", strtotime('+3 day', strtotime(date("Y-m-d"))));
    $menos_un_dia = date("Y-m-d", strtotime('-1 day', strtotime(date("Y-m-d"))));
    $menos_dia = date("Y-m-d", strtotime('-5 day', strtotime(date("Y-m-d"))));
    $nom_tabla = (new \App\Models\Pedido())->getTable();
    
    $consulta = DB::table('pedidos')->select(
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_log = '".config('app.en_espera_de_produccion')."' OR estat_log = '".config('app.en_almacen_de_salida')."' OR estat_log = '".config('app.en_ruta')."' OR estat_log = '".config('app.sin_entrega_por_falta_de_informacion')."' OR estat_log = '".config('app.intento_de_entrega_fallido')."') AND (fech_de_entreg BETWEEN '$fecha' AND '$mas_dia')) as porEntregar"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_log = '".config('app.en_espera_de_produccion')."' OR estat_log = '".config('app.en_almacen_de_salida')."' OR estat_log = '".config('app.en_ruta')."' OR estat_log = '".config('app.sin_entrega_por_falta_de_informacion')."' OR estat_log = '".config('app.intento_de_entrega_fallido')."') AND (fech_de_entreg BETWEEN '$menos_dia' AND '$menos_un_dia')) as yaCaducados"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_log = '".config('app.en_espera_de_produccion')."' OR estat_log = '".config('app.en_almacen_de_salida')."' OR estat_log = '".config('app.en_ruta')."' OR estat_log = '".config('app.sin_entrega_por_falta_de_informacion')."' OR estat_log = '".config('app.intento_de_entrega_fallido')."') AND (estat_pag != '".config('app.pagado')."')) as pteDePago"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_log = '".config('app.en_espera_de_produccion')."' OR estat_log = '".config('app.en_almacen_de_salida')."' OR estat_log = '".config('app.en_ruta')."' OR estat_log = '".config('app.sin_entrega_por_falta_de_informacion')."' OR estat_log = '".config('app.intento_de_entrega_fallido')."') AND (estat_pag = '".config('app.pago_rechazado')."')) as pagoRechazado"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_log = '".config('app.en_espera_de_produccion')."' OR estat_log = '".config('app.en_almacen_de_salida')."' OR estat_log = '".config('app.en_ruta')."' OR estat_log = '".config('app.sin_entrega_por_falta_de_informacion')."' OR estat_log = '".config('app.intento_de_entrega_fallido')."') AND (estat_vent_gen != '".config('app.falta_informacion_general')."' OR estat_vent_dir != '".config('app.falta_detallar_direccion')."')) as pteDeInformacion"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_log = '".config('app.en_espera_de_produccion')."' OR estat_log = '".config('app.en_almacen_de_salida')."' OR estat_log = '".config('app.en_ruta')."' OR estat_log = '".config('app.sin_entrega_por_falta_de_informacion')."' OR estat_log = '".config('app.intento_de_entrega_fallido')."') AND (estat_log = '".config('app.sin_entrega_por_falta_de_informacion')."')) as sinEntregaPorFaltaDeInformacion"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_log = '".config('app.en_espera_de_produccion')."' OR estat_log = '".config('app.en_almacen_de_salida')."' OR estat_log = '".config('app.en_ruta')."' OR estat_log = '".config('app.sin_entrega_por_falta_de_informacion')."' OR estat_log = '".config('app.intento_de_entrega_fallido')."') AND (estat_log = '".config('app.intento_de_entrega_fallido')."')) as intentoDeEntregaFallido"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_log = '".config('app.en_espera_de_produccion')."' OR estat_log = '".config('app.en_almacen_de_salida')."' OR estat_log = '".config('app.en_ruta')."' OR estat_log = '".config('app.sin_entrega_por_falta_de_informacion')."' OR estat_log = '".config('app.intento_de_entrega_fallido')."') AND (urg = '".config('opcionesSelect.es_pedido_urgente.Si')."')) as urgente")
    )->first();
    if($consulta == null) { 
      $consulta = (object) array('porEntregar' => 0, 'yaCaducados' => 0, 'pteDePago' => 0, 'pagoRechazado' => 0, 'pteDeInformacion' => 0, 'sinEntregaPorFaltaDeInformacion' => 0, 'intentoDeEntregaFallido' => 0, 'urgente' => 0);
    }

    return $consulta; 
  }
}