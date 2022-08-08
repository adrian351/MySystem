<?php
namespace App\Http\Controllers\Rastrea;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Models
use App\Models\Pedido;
// Repositories
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;

class RastreaPedidoController extends Controller {
  protected $pedidoActivoRepo;
  public function __construct(PedidoActivoRepositories $pedidoActivoRepositories) {
    $this->pedidoActivoRepo = $pedidoActivoRepositories;
  }
  public function index(Request $request) {
    if($request->opcion_buscador != null) {
      $pedidos = Pedido::with('usuario')->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
    } else {
      $pedidos = Pedido::with('usuario')->where('id', '!')->orderBy('id', 'DESC')->paginate($request->paginador);
    }
    return view('rastrea.rpe_index', compact('pedidos'));
  }
  public function show($id_pedido) {
    $pedido         = $this->pedidoActivoRepo->getPedidoFindOrFail($id_pedido, ['usuario', 'unificar', 'armados', 'pagos']);
    $unificados     = $pedido->unificar()->paginate(99999999);
    $armados        = $this->pedidoActivoRepo->getArmadosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $pagos          = $this->pedidoActivoRepo->getPagosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $mont_pag_aprov =  $this->pedidoActivoRepo->getMontoDePagosAprobados($pedido);
    return view('rastrea.pedido.rpe_show', compact('pedido', 'unificados', 'armados', 'pagos', 'mont_pag_aprov'));
  }
  public function rastrearPorQR($id, $modulo, $otro = null) {
    if($modulo == 'Almacén' OR $modulo == 'Producción' OR $modulo == 'Logística') {
      return $this->pedido($id, $modulo);
    }
    if($modulo == 'Comprobante de salida' OR $modulo == 'Comprobante de entrega') {
      return $this->direccion($id, $modulo, $otro);
    }
    echo 'Opción 1 invalida';
  }
  public function pedido($id, $modulo) {
    $pedido =  Pedido::findorfail($id);
    switch ($modulo) {
      case 'Almacén':
        if($pedido->estat_alm == config('app.productos_completos_terminado')) {
          return redirect(route('almacen.pedidoTerminado.show', \Crypt::encrypt($pedido->id)));
        }
        return redirect(route('almacen.pedidoActivo.show', \Crypt::encrypt($pedido->id)));
      case 'Producción':
        if($pedido->estat_produc == config('app.en_almacen_de_salida_terminado')) {
          return redirect(route('produccion.pedidoTerminado.show', \Crypt::encrypt($pedido->id)));
        }
        return redirect(route('produccion.pedidoActivo.show', \Crypt::encrypt($pedido->id)));
      case 'Logística':
        if($pedido->estat_log == config('app.en_almacen_de_salida_terminado')) {
          return redirect(route('logistica.pedidoEntregado.show', \Crypt::encrypt($pedido->id)));
        }
        return redirect(route('logistica.pedidoActivo.show', \Crypt::encrypt($pedido->id)));
      default:
        echo 'Opción 2 invalida';
    }
  }
  public function direccion($id, $modulo, $for_loc) {
    $direccion = \App\Models\PedidoArmadoTieneDireccion::findorfail($id);
    switch ($modulo) {
      case 'Comprobante de salida':
        if($direccion->comp_de_sal_nom != null) {
          echo 'Ya se ha subido el comprobante de salida con anterioridad';
          break;
        }
        if($for_loc == config('opcionesSelect.select_foraneo_local.Foráneo')) {
          $ruta = 'logistica.direccionForaneo.create';
        }elseif($for_loc == config('opcionesSelect.select_foraneo_local.Local')) {
          $ruta = 'logistica.direccionLocal.create';
        }
        return redirect(route($ruta, \Crypt::encrypt($direccion->id)));
      case 'Comprobante de entrega':
        if($direccion->estat == config('app.entregado')) {
          echo 'Ya se ha subido el comprobante de entrega con anterioridad';
          break;
        }
        if($for_loc == config('opcionesSelect.select_foraneo_local.Foráneo')) {
          $ruta = 'logistica.direccionForaneo.createEntrega';
        }elseif($for_loc == config('opcionesSelect.select_foraneo_local.Local')) {
          $ruta = 'logistica.direccionLocal.createEntrega';
        }
        return redirect(route($ruta, \Crypt::encrypt($direccion->id)));
      default:
        echo 'Opción 3 invalida';
    }
  }
}