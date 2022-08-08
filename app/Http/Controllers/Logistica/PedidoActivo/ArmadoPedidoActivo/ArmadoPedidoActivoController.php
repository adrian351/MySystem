<?php
namespace App\Http\Controllers\Logistica\PedidoActivo\ArmadoPedidoActivo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\logistica\pedidoActivo\armadoPedidoActivo\UpdateArmadoPedidoActivoRequest;
use App\Http\Requests\produccion\pedidoActivo\armadoPedidoActivo\UpdateModalArmadoPedidoActivoRequest;
// Repositories
use App\Repositories\logistica\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;

class ArmadoPedidoActivoController extends Controller {
  protected $armadoPedidoActivoRepo;
  public function __construct(ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories) {
    $this->armadoPedidoActivoRepo = $armadoPedidoActivoRepositories;
  }
  public function show(Request $request, $id_armado) {
    $armado       = $this->armadoPedidoActivoRepo->armadoPedidoActivoFindOrFailById($id_armado, ['pedido', 'productos'], 'show');
    $productos    = $armado->productos()->with(['sustitutos', 'productos_original'])->get();
    $direcciones  = $this->armadoPedidoActivoRepo->getArmadoPedidoTieneDireccionesPaginate($armado, $request);
    return view('logistica.pedido.pedido_activo.armado_activo.armAct_show', compact('armado', 'productos', 'direcciones'));
  }
  public function edit(Request $request, $id_armado) {
    $armado     = $this->armadoPedidoActivoRepo->armadoPedidoActivoFindOrFailById($id_armado, ['pedido'], 'edit');
    $pedido       = $armado->pedido()->firstOrFail();
    $direcciones  = $this->armadoPedidoActivoRepo->getArmadoPedidoTieneDireccionesPaginate($armado, $request);
    return view('logistica.pedido.pedido_activo.armado_activo.armAct_edit', compact('armado', 'pedido', 'direcciones'));
  }
  public function update(UpdateArmadoPedidoActivoRequest $request, $id_armado) {
    $this->armadoPedidoActivoRepo->update($request, $id_armado);
    toastr()->success('¡Armado actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function updateModal(UpdateModalArmadoPedidoActivoRequest $request, $id_armado) {
    $armado = $this->armadoPedidoActivoRepo->updateModal($request, $id_armado);
    toastr()->success('¡Armado actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}