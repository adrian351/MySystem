<?php
namespace App\Http\Controllers\Logistica\PedidoEntregado\ArmadoPedidoEntregado\DireccionArmado;
use App\Http\Controllers\Controller;
// Repositories
use App\Repositories\logistica\direccionLocal\DireccionLocalRepositories;

class DireccionArmadoController extends Controller {
  protected $direccionLocalRepo;
  public function __construct(DireccionLocalRepositories $direccionLocalRepositories) {
    $this->direccionLocalRepo   = $direccionLocalRepositories;
  }
  public function show($id_direccion) {
    $direccion    = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, config('opcionesSelect.select_foraneo_local.Local'), ['comprobantes', 'armado'], 'show', null);
    $comprobantes = $direccion->comprobantes;
    $armado       = $direccion->armado;
    return view('logistica.pedido.pedido_entregado.armado_entregado.direccion_armado.dirArm_show', compact('direccion', 'comprobantes', 'armado'));
  }
}