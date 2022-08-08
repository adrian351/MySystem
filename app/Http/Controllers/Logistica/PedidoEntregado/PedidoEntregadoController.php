<?php
namespace App\Http\Controllers\Logistica\PedidoEntregado;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\logistica\pedidoEntregado\PedidoEntregadoRepositories;
use App\Repositories\logistica\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;
class PedidoEntregadoController extends Controller {
  protected $pedidoEntregadoRepo;
  public function __construct(PedidoEntregadoRepositories $pedidoEntregadoRepositories, ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories) {
    $this->pedidoEntregadoRepo    = $pedidoEntregadoRepositories;  
    $this->armadoPedidoActivoRepo = $armadoPedidoActivoRepositories;    
  }
  public function index(Request $request) {
    $pedidos = $this->pedidoEntregadoRepo->getPagination($request, ['usuario', 'unificar']);
    return view('logistica.pedido.pedido_entregado.pedEnt_index', compact('pedidos'));
  }
  public function show(Request $request, $id_pedido) {
    $pedido                        = $this->pedidoEntregadoRepo->pedidoEntregadoFindOrFailById($id_pedido);
    $unificados                    = $pedido->unificar()->paginate(99999999);
    $archivos                      = $pedido->archivos()->paginate(99999999);
    $armados                       = $this->pedidoEntregadoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_entregados_logistica  = $this->armadoPedidoActivoRepo->armadosTerminadosLogistica($pedido->id, [config('app.entregado')]);
    return view('logistica.pedido.pedido_entregado.pedEnt_show', compact('pedido', 'unificados', 'archivos', 'armados', 'armados_entregados_logistica'));    
  }
}