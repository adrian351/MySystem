<?php
namespace App\Http\Controllers\Logistica\PedidoEntregado\ArmadoPedidoEntregado;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\logistica\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;

class ArmadoPedidoEntregadoController extends Controller {
  protected $armadoPedidoActivoRepo;
  public function __construct(ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories) {
    $this->armadoPedidoActivoRepo = $armadoPedidoActivoRepositories;
  }
  public function show(Request $request, $id_armado) {
    $armado     = $this->armadoPedidoActivoRepo->armadoPedidoActivoFindOrFailById($id_armado, ['pedido', 'productos'], 'show');
    // Verifica si el pedido relacionado a este armado cumple con la fecha dentro del rango de visualizar
    $armado->pedido()->whereBetween('fech_estat_log', [date("Y-m-d", strtotime('-90 day', strtotime(date("Y-m-d")))), date("Y-m-d", strtotime('+1 day', strtotime(date("Y-m-d"))))])->firstOrFail();
    $productos    = $armado->productos()->with(['sustitutos', 'productos_original'])->get();
    $direcciones  = $this->armadoPedidoActivoRepo->getArmadoPedidoTieneDireccionesPaginate($armado, $request);
    return view('logistica.pedido.pedido_entregado.armado_entregado.armEnt_show', compact('armado', 'productos', 'direcciones'));
  }
}