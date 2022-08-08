<?php
namespace App\Http\Controllers\Produccion\PedidoActivo\ArmadoPedidoActivo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\produccion\pedidoActivo\armadoPedidoActivo\UpdateArmadoPedidoActivoRequest;
use App\Http\Requests\produccion\pedidoActivo\armadoPedidoActivo\UpdateModalArmadoPedidoActivoRequest;
// Repositories
use App\Repositories\produccion\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;
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
    $armado       = $this->armadoPedidoActivoRepo->armadoPedidoActivoFindOrFailById($id_armado, ['pedido', 'productos'], 'show');
    $productos    = $armado->productos()->with(['sustitutos', 'productos_original'])->get();
    $direcciones  = $this->armadoPedidoActivoRepo->getArmadoPedidoTieneDireccionesPaginate($armado, $request);
    return view('produccion.pedido.pedido_activo.armado_activo.armAct_show', compact('armado', 'productos', 'direcciones'));
  }
  public function edit(Request $request, $id_armado) {
    $armado     = $this->armadoPedidoActivoRepo->armadoPedidoActivoFindOrFailById($id_armado, ['pedido'], 'edit');
    return view('produccion.pedido.pedido_activo.armado_activo.armAct_edit', compact('armado'));
  }
  public function update(UpdateArmadoPedidoActivoRequest $request, $id_armado) {
    $armado = $this->armadoPedidoActivoRepo->update($request, $id_armado);
    toastr()->success('¡Armado actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    if($armado->estat == config('app.en_almacen_de_salida') OR $armado->estat == config('app.en_revision_de_productos')) {
      if($armado->pedido->estat_produc == config('app.en_almacen_de_salida_terminado')) {
        toastr()->info('¡Pedido terminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
        return redirect(route('produccion.pedidoActivo.index')); 
      }
      return redirect(route('produccion.pedidoActivo.edit', $this->serviceCrypt->encrypt($armado->pedido_id))); 
    }
    return back();
  }
  public function updateModal(UpdateModalArmadoPedidoActivoRequest $request, $id_armado) {
    $armado = $this->armadoPedidoActivoRepo->updateModal($request, $id_armado);
    toastr()->success('¡Armado actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    if($armado->estat == config('app.en_almacen_de_salida') OR $armado->estat == config('app.en_revision_de_productos')) {
      if($armado->pedido->estat_produc == config('app.en_almacen_de_salida_terminado')) {
        toastr()->info('¡Pedido terminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
        return redirect(route('produccion.pedidoActivo.index')); 
      }
      return redirect(route('produccion.pedidoActivo.edit', $this->serviceCrypt->encrypt($armado->pedido_id))); 
    }
    return back();
  }
}
