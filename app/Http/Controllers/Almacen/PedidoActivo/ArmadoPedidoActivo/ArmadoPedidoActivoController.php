<?php
namespace App\Http\Controllers\Almacen\PedidoActivo\ArmadoPedidoActivo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\almacen\pedidoActivo\armadoPedidoActivo\UpdateArmadoPedidoActivoRequest;
// Repositories
use App\Repositories\almacen\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class ArmadoPedidoActivoController extends Controller {
  protected $serviceCrypt;
  protected $armadoPedidoActivoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories) {
    $this->serviceCrypt           = $serviceCrypt;
    $this->armadoPedidoActivoRepo = $armadoPedidoActivoRepositories;
  }
  public function show(Request $request, $id_armado) {
    $armado     = $this->armadoPedidoActivoRepo->armadoPedidoActivoFindOrFailById($id_armado, ['pedido', 'direcciones', 'productos'], 'show');
    $pedido     = $armado->pedido()->firstOrFail();
    $productos  = $armado->productos()->with(['sustitutos', 'productos_original'])->get();
    $direcciones  = $armado->direcciones()->paginate(99999999);
    return view('almacen.pedido.pedido_activo.armado_activo.alm_pedAct_armAct_show', compact('armado', 'pedido', 'productos', 'direcciones'));
  }
  public function edit(Request $request, $id_armado) { 
    $armado     = $this->armadoPedidoActivoRepo->armadoPedidoActivoFindOrFailById($id_armado, ['pedido'], 'edit');
    $pedido     = $armado->pedido()->firstOrFail();
    $productos  = $this->armadoPedidoActivoRepo->getArmadoPedidoTieneProductosPaginate($armado, $request);
    return view('almacen.pedido.pedido_activo.armado_activo.alm_pedAct_armAct_edit', compact('armado', 'pedido', 'productos'));
  }
  public function update(UpdateArmadoPedidoActivoRequest $request, $id_armado) {
    $armado = $this->armadoPedidoActivoRepo->update($request, $id_armado);
    toastr()->success('¡Armado actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    if($armado->estat == config('app.productos_completos') OR $armado->estat == config('app.en_almacen_de_salida')) {
      if($armado->pedido->estat_alm == config('app.productos_completos_terminado')) {
        toastr()->info('¡Pedido terminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
        return redirect(route('almacen.pedidoActivo.index')); 
      }
      return redirect(route('almacen.pedidoActivo.edit', $this->serviceCrypt->encrypt($armado->pedido_id))); 
    }
    return back();
  }
}