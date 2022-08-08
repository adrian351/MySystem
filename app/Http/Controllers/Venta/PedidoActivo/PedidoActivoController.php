<?php
namespace App\Http\Controllers\Venta\PedidoActivo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\venta\pedidoActivo\UpdatePedidoRequest;
// Repositories
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;
use DB;
use App\Models\Pedido;

class PedidoActivoController extends Controller {
  protected $pedidoActivoRepo;
  public function __construct(PedidoActivoRepositories $pedidoActivoRepositories) {
    $this->pedidoActivoRepo = $pedidoActivoRepositories;
  }
  public function index(Request $request, $opc_consulta = null) {
    $pedidos = $this->pedidoActivoRepo->getPagination($request, ['usuario', 'unificar'], $opc_consulta);
    $pen = $this->pedidoActivoRepo->getPendientes();
    return view('venta.pedido.pedido_activo.ven_pedAct_index', compact('pedidos', 'pen'));
  }
  public function show($id_pedido) {
    $pedido         = $this->pedidoActivoRepo->pedidoAsignadoFindOrFailById($id_pedido, ['usuario', 'archivos', 'unificar', 'armados', 'pagos']);
    $unificados     = $pedido->unificar()->paginate(99999999);
    $archivos       = $pedido->archivos()->paginate(99999999);
    $armados        = $this->pedidoActivoRepo->getArmadosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $pagos          = $this->pedidoActivoRepo->getPagosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $mont_pag_aprov =  $this->pedidoActivoRepo->getMontoDePagosAprobados($pedido);
    return view('venta.pedido.pedido_activo.ven_pedAct_show', compact('pedido', 'unificados', 'archivos', 'armados', 'pagos', 'mont_pag_aprov'));
  }
  public function edit($id_pedido) {
    $pedido         = $this->pedidoActivoRepo->pedidoAsignadoFindOrFailById($id_pedido, ['unificar', 'archivos', 'armados', 'pagos']);
    $unificados     = $pedido->unificar()->paginate(99999999);
    $archivos       = $pedido->archivos()->paginate(99999999);
    $armados        = $this->pedidoActivoRepo->getArmadosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $pagos          = $this->pedidoActivoRepo->getPagosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $mont_pag_aprov =  $this->pedidoActivoRepo->getMontoDePagosAprobados($pedido);
    $pedido_date = $this->pedidoActivoRepo->fechaDeEntrega($pedido);
    $init = $this->pedidoActivoRepo->Busca($pedido);
    $totalarmados = $pedido->arm_carg;
    return view('venta.pedido.pedido_activo.ven_pedAct_edit', compact('pedido', 'unificados', 'archivos', 'armados', 'pagos', 'mont_pag_aprov', 'pedido_date','init','totalarmados'));
  }
  public function update(UpdatePedidoRequest $request, $id_pedido) {
    $this->pedidoActivoRepo->update($request, $id_pedido);
    toastr()->success('¡Pedido actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_pedido) {
    $this->pedidoActivoRepo->destroy($id_pedido);
    toastr()->success('¡Pedido eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    toastr()->info('Stock de Productos y Armados actualiado exitosamente');
    return back();
  }
// ->where('bod', '=', 'Temas')->
  public function total($fecha) {
    $fecha = explode(',',$fecha);
    $total= Pedido::wheredate('fech_de_entreg',"=",$fecha[0])->select( DB::raw('SUM(arm_carg) as total'))->first()->total;
    if($total != 0){
      $resta = 3000 - $total;
      if(($resta)-($fecha[1])>= 0){
          // return "true(".$total;
          return $total;
      }else{
          // return "Se supera el limite existen ".$total;
          return $total;
      }
    }else{
      return;
    }
  }
}