<?php
namespace App\Http\Controllers\Venta\PedidoActivo\ArmadoPedidoActivo;
use App\Http\Controllers\Controller;
use App\Http\Requests\venta\pedidoActivo\armado\UpdateArmadoRequest;
use App\Http\Requests\venta\pedidoActivo\armado\UpdateArmadoDireccionRequest;
use App\Http\Requests\venta\pedidoActivo\armado\DividirDireccionArmadoRequest;
// Repositories
use App\Repositories\venta\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;
use App\Repositories\armado\ArmadoRepositories;
// servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class ArmadoPedidoActivoController extends Controller {
  protected $serviceCrypt;
  protected $armadoPedidoActivoRepo;
  protected $armadoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories, ArmadoRepositories $armadoRepositories) {
    $this->armadoPedidoActivoRepo = $armadoPedidoActivoRepositories;
    $this->armadoRepo             = $armadoRepositories;
    $this->serviceCrypt           = $serviceCrypt;
  }
  public function show($id_armado) {
    $armado       = $this->armadoPedidoActivoRepo->armadoFindOrFailById($id_armado, ['productos', 'direcciones', 'pedido']);
    $pedido       = $armado->pedido()->firstOrFail();
    $productos    = $armado->productos()->with(['sustitutos', 'productos_original'])->get();
    $direcciones  = $armado->direcciones()->paginate(99999999);
    return view('venta.pedido.pedido_activo.armado_pedidoActivo.ven_arm_pedAct_show', compact('armado', 'pedido', 'productos', 'direcciones'));
  }
  public function edit($id_armado) {
    $armado       = $this->armadoPedidoActivoRepo->armadoFindOrFailById($id_armado, ['direcciones', 'pedido']);
    $pedido       = $armado->pedido()->firstOrFail();
    $direcciones  = $armado->direcciones()->paginate(99999999);
    return view('venta.pedido.pedido_activo.armado_pedidoActivo.ven_arm_pedAct_edit', compact('armado', 'pedido', 'direcciones'));
  }
  public function update(UpdateArmadoRequest $request, $id_armado) {
    $this->armadoPedidoActivoRepo->update($request, $id_armado);
    toastr()->success('¡Armado actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }

  public function updateDirecciones(UpdateArmadoDireccionRequest $request, $id_armado){
    
    $this->armadoPedidoActivoRepo->updateDirecciones($request, $id_armado);
    toastr()->success('¡Direcciones actualizadas exitosamente!');
    return back();
  }

  public function dividirDireccion(DividirDireccionArmadoRequest $request, $id_armado){
    $this->armadoPedidoActivoRepo->dividirDireccion($request, $id_armado);
    toastr()->success('¡Dirección dividída correctamente!');
    return back();
  }
  
}