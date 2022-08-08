<?php
namespace App\Http\Controllers\Produccion\PedidoActivo\ArmadoPedidoActivo\Direccion;
use App\Http\Controllers\Controller;
// Repositories
use App\Repositories\venta\pedidoActivo\armadoPedidoActivo\direccion\DireccionArmadoRepositories;

class DireccionController extends Controller {
  protected $direccionArmadoRepo;
  public function __construct(DireccionArmadoRepositories $direccionArmadoRepositories) {
    $this->direccionArmadoRepo = $direccionArmadoRepositories;
  }
  public function show($id_direccion) {
    $direccion = $this->direccionArmadoRepo->direccionFindOrFailById($id_direccion, ['comprobantes', 'armado']);
    $comprobantes = $direccion->comprobantes;
    return view('produccion.pedido.pedido_activo.armado_activo.direccion_armado.dirArm_show', compact('comprobantes', 'direccion'));
  }
}