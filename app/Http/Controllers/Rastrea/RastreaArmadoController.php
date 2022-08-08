<?php
namespace App\Http\Controllers\Rastrea;
use App\Http\Controllers\Controller;
// Repositories
use App\Repositories\venta\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;
use App\Repositories\armado\ArmadoRepositories;

class RastreaArmadoController extends Controller {
  protected $armadoPedidoActivoRepo;
  protected $armadoRepo;
  public function __construct(ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories, ArmadoRepositories $armadoRepositories) {
    $this->armadoPedidoActivoRepo = $armadoPedidoActivoRepositories;
    $this->armadoRepo             = $armadoRepositories;
  }
  public function show($id_armado) {
    $armado       = $this->armadoPedidoActivoRepo->armadoFindOrFailById($id_armado, ['productos', 'direcciones', 'pedido']);
    $pedido       = $armado->pedido()->firstOrFail();
    $productos    = $armado->productos()->with(['sustitutos', 'productos_original'])->get();
    $direcciones  = $armado->direcciones()->paginate(99999999);
    return view('rastrea.pedido.armado.arm_show', compact('armado', 'pedido', 'productos', 'direcciones'));
  }
}