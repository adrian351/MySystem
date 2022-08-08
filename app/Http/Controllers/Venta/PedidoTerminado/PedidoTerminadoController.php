<?php
namespace App\Http\Controllers\Venta\PedidoTerminado;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\venta\pedidoTerminado\UpdatePedidoRequest;
// Repositories
use App\Repositories\venta\pedidoTerminado\PedidoTerminadoRepositories;
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;

class PedidoTerminadoController extends Controller {
  protected $pedidoTerminadoRepo;
  protected $pedidoActivoRepo;
  public function __construct(PedidoTerminadoRepositories $PedidoTerminadoRepositories, PedidoActivoRepositories $pedidoActivoRepositories) {
    $this->pedidoTerminadoRepo  = $PedidoTerminadoRepositories;
    $this->pedidoActivoRepo = $pedidoActivoRepositories;    
  }
  public function index(Request $request, $opc_consulta = null) {
    $pedidos = $this->pedidoTerminadoRepo->getPagination($request, ['usuario', 'unificar'], $opc_consulta);
    return view('venta.pedido.pedido_terminado.ven_pedTer_index', compact('pedidos'));
  }
  public function show(Request $request, $id_pedido) {
    $pedido         = $this->pedidoTerminadoRepo->pedidoTerminadoFindOrFailById($id_pedido, ['usuario', 'archivos','unificar', 'armados', 'pagos']);
    $unificados     = $pedido->unificar()->paginate(99999999);
    $archivos       = $pedido->archivos()->paginate(99999999);
    $armados        = $pedido->armados()->paginate(99999999);
    $pagos          = $pedido->pagos()->paginate(99999999);
    $mont_pag_aprov =  $this->pedidoActivoRepo->getMontoDePagosAprobados($pedido);
    return view('venta.pedido.pedido_terminado.ven_pedTer_show', compact('pedido', 'unificados', 'archivos','armados', 'pagos', 'mont_pag_aprov'));
  }
  public function update(UpdatePedidoRequest $request, $id_pedido) {
    $this->pedidoTerminadoRepo->update($request, $id_pedido);
    toastr()->success('¡Pedido actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_pedido) {
    $this->pedidoTerminadoRepo->destroy($id_pedido);
    toastr()->success('¡Pedido eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}