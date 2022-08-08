<?php
namespace App\Http\Controllers\Venta\PedidoTerminado\ArmadoPedidoTerminado\Direccion;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\venta\pedidoActivo\armado\direccion\UpdateDireccionRequest;
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
    return view('venta.pedido.pedido_terminado.armado.direccion.dir_show', compact('comprobantes', 'direccion'));
  }
}