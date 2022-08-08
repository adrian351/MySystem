<?php
namespace App\Http\Controllers\Venta\PedidoTerminado\ArmadoPedidoTerminado;
use App\Http\Controllers\Controller;
// Repositories
use App\Repositories\venta\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;

class ArmadoPedidoTerminadoController extends Controller {
  protected $armadoPedidoActivoRepo;
  public function __construct(ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories) {
    $this->armadoPedidoActivoRepo = $armadoPedidoActivoRepositories;
  }
  public function show($id_armado) {
    $armado       = $this->armadoPedidoActivoRepo->armadoFindOrFailById($id_armado, ['productos', 'direcciones', 'pedido']);
    $pedido       = $armado->pedido()->firstOrFail();
    $productos    = $armado->productos()->with(['sustitutos', 'productos_original'])->get();
    $direcciones  = $armado->direcciones()->paginate(99999999);
    return view('venta.pedido.pedido_terminado.armado.arm_show', compact('armado', 'pedido', 'productos', 'direcciones'));
  }
}