<?php
namespace App\Http\Controllers\RolCliente\Pedido;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\rolCliente\pedido\UpdatePedidoRequest;
// Repositories
use App\Repositories\rolCliente\pedido\PedidoClienteRepositories;
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;

class PedidoController extends Controller {
  protected $pedidoClienteRepo;
  protected $pedidoActivoRepo;
  public function __construct(PedidoClienteRepositories $pedidoClienteRepositories, PedidoActivoRepositories $pedidoActivoRepositories) {
    $this->pedidoClienteRepo  = $pedidoClienteRepositories;
    $this->pedidoActivoRepo   = $pedidoActivoRepositories;
  }
  public function index(Request $request) {
    $pedidos = $this->pedidoClienteRepo->getPagination($request);
    return view('rolCliente.pedido.ped_index', compact('pedidos'));
  }
  public function show($id_pedido) {
    $pedido         = $this->pedidoClienteRepo->getPedidoFindOrFailById($id_pedido, ['usuario', 'unificar', 'armados', 'pagos'], null);
    $unificados     = $pedido->unificar()->paginate(99999999);
    $armados        = $this->pedidoActivoRepo->getArmadosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $pagos          = $this->pedidoActivoRepo->getPagosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $mont_pag_aprov = $this->pedidoActivoRepo->getMontoDePagosAprobados($pedido);
    return view('rolCliente.pedido.ped_show', compact('pedido', 'unificados', 'armados', 'pagos', 'mont_pag_aprov'));
  }
  public function edit($id_pedido) {
    $pedido   = $this->pedidoClienteRepo->getPedidoFindOrFailById($id_pedido, ['armados'], config('app.entregado'));
    if($pedido->estat_vent_gen == config('app.informacion_general_completa') AND $pedido->estat_vent_arm == config('app.armados_cargados') AND $pedido->estat_vent_dir == config('app.direccion_de_armados_asignado')) {
      return abort('404');
    }
    $armados  = $pedido->armados()->with('direcciones')->get();
    return view('rolCliente.pedido.ped_edit', compact('pedido', 'armados'));
  }
  public function update(UpdatePedidoRequest $request, $id_pedido) {
    $pedido = $this->pedidoClienteRepo->update($request, $id_pedido);
    toastr()->success('¡Pedido actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    if($pedido->estat_vent_gen == config('app.informacion_general_completa') AND $pedido->estat_vent_arm == config('app.armados_cargados') AND $pedido->estat_vent_dir == config('app.direccion_de_armados_asignado')) {
      toastr()->success('¡Pedido detallado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return redirect(route('rolCliente.pedido.index'));
    }
    return back();
  }
  public function getFaltanteDePago(Request $request, $id_pedido) {
    if($request->ajax()) {
      $resultado = $this->pedidoClienteRepo->getFaltanteDePago($id_pedido);
      return $resultado;
    } else {
      return view('home');
    }
  }
}