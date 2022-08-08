<?php
namespace App\Http\Controllers\Produccion\PedidoTerminado;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\produccion\pedidoTerminado\PedidoTerminadoRepositories;
use App\Repositories\produccion\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;

class PedidoTerminadoController extends Controller {
  public function __construct(PedidoTerminadoRepositories $PedidoTerminadoRepositories, ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories) {
    $this->pedidoTerminadoRepo    = $PedidoTerminadoRepositories;  
    $this->armadoPedidoActivoRepo = $armadoPedidoActivoRepositories;    
  }
  public function index(Request $request) {
    $pedidos = $this->pedidoTerminadoRepo->getPagination($request, ['usuario', 'unificar']);
    return view('produccion.pedido.pedido_terminado.pedTer_index', compact('pedidos'));
  }
  public function show(Request $request, $id_pedido) {
    $pedido                        = $this->pedidoTerminadoRepo->pedidoTerminadoFindOrFailById($id_pedido);
    $unificados                    = $pedido->unificar()->paginate(99999999);
    $archivos                       = $pedido->archivos()->paginate(99999999);
    $armados                       = $this->pedidoTerminadoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_terminados_produccion = $this->armadoPedidoActivoRepo->armadosTerminadosProduccion($pedido->id, [config('app.en_almacen_de_salida'), config('app.en_ruta'), config('app.entregado'), config('app.sin_entrega_por_falta_de_informacion'), config('app.intento_de_entrega_fallido')]);
    return view('produccion.pedido.pedido_terminado.pedTer_show', compact('pedido', 'unificados', 'archivos', 'armados', 'armados_terminados_produccion'));    
  }
}