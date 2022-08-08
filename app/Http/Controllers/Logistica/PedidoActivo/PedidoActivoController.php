<?php
namespace App\Http\Controllers\Logistica\PedidoActivo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\logistica\pedidoActivo\UpdatePedidoActivoRequest;
// Repositories
use App\Repositories\logistica\pedidoActivo\PedidoActivoRepositories;
use App\Repositories\logistica\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;

class PedidoActivoController extends Controller {
  protected $pedidoActivoRepo;
  protected $armadoPedidoActivoRepo;
  public function __construct(PedidoActivoRepositories $PedidoActivoRepositories, ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories) {
    $this->pedidoActivoRepo         = $PedidoActivoRepositories;
    $this->armadoPedidoActivoRepo   = $armadoPedidoActivoRepositories;
  }
  public function index(Request $request, $opc_consulta = null) {
    $pedidos = $this->pedidoActivoRepo->getPagination($request, ['usuario', 'unificar'], $opc_consulta);
    $pen = $this->pedidoActivoRepo->getPendientes();
    return view('logistica.pedido.pedido_activo.pedAct_index', compact('pedidos', 'pen'));
  }
  public function show(Request $request, $id_pedido) {
    $pedido                        = $this->pedidoActivoRepo->pedidoActivoLogisticaFindOrFailById($id_pedido, ['usuario', 'unificar']);
    $unificados                    = $pedido->unificar()->paginate(99999999);
    $archivos                      = $pedido->archivos()->paginate(99999999);
    $armados                       = $this->pedidoActivoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_entregados_logistica = $this->armadoPedidoActivoRepo->armadosTerminadosLogistica($pedido->id, [config('app.entregado')]);
    return view('logistica.pedido.pedido_activo.pedAct_show', compact('pedido', 'unificados', 'archivos', 'armados', 'armados_entregados_logistica'));
  }
  public function edit(Request $request, $id_pedido) {
    $pedido                         = $this->pedidoActivoRepo->pedidoActivoLogisticaFindOrFailById($id_pedido, ['unificar']);
    $unificados                     = $pedido->unificar()->paginate(99999999);
    $armados                        = $this->pedidoActivoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_entregados_logistica  = $this->armadoPedidoActivoRepo->armadosTerminadosLogistica($pedido->id, [config('app.entregado')]);
    return view('logistica.pedido.pedido_activo.pedAct_edit', compact('pedido', 'unificados', 'armados', 'armados_entregados_logistica'));
  }
  public function update(UpdatePedidoActivoRequest $request, $id_pedido) {
    $this->pedidoActivoRepo->update($request, $id_pedido);
    toastr()->success('¡Pedido actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function generarReporte() {
    return (new \App\Exports\logistica\pedido\pedidoActivo\activoExport)->download('PedidosActivos-'.date('Y-m-d').'.xlsx');
  }
}