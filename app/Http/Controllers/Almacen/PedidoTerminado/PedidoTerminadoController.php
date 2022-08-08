<?php
namespace App\Http\Controllers\Almacen\PedidoTerminado;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\almacen\pedidoTerminado\PedidoTerminadoRepositories;
use App\Repositories\almacen\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;

class PedidoTerminadoController extends Controller {
  protected $pedidoTerminadoRepo;
  protected $armadoPedidoActivoRepo;
  public function __construct(PedidoTerminadoRepositories $PedidoTerminadoRepositories, ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories) {
    $this->pedidoTerminadoRepo    = $PedidoTerminadoRepositories;  
    $this->armadoPedidoActivoRepo = $armadoPedidoActivoRepositories;    
  }
  public function index(Request $request) {
    $pedidos = $this->pedidoTerminadoRepo->getPagination($request, ['usuario', 'unificar']);
    return view('almacen.pedido.pedido_terminado.pedTer_index', compact('pedidos'));
  }
  public function show(Request $request, $id_pedido) {
    $pedido                     = $this->pedidoTerminadoRepo->pedidoTerminadoFindOrFailById($id_pedido);
    $unificados                 = $pedido->unificar()->paginate(99999999);
    $archivos                   = $pedido->archivos()->paginate(99999999);
    $armados                    = $this->pedidoTerminadoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_terminados_almacen = $this->armadoPedidoActivoRepo->armadosTerminadosAlmacen($pedido->id, [config('app.productos_completos'), config('app.en_produccion'), config('app.en_almacen_de_salida'), config('app.en_ruta'), config('app.entregado'), config('app.sin_entrega_por_falta_de_informacion'), config('app.intento_de_entrega_fallido')]);
    return view('almacen.pedido.pedido_terminado.pedTer_show', compact('pedido', 'unificados', 'archivos', 'armados', 'armados_terminados_almacen'));
  }
}