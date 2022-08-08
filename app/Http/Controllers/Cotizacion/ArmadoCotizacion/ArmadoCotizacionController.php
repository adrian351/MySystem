<?php
namespace App\Http\Controllers\Cotizacion\ArmadoCotizacion;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\cotizacion\armadoCotizacion\StoreArmadoCotizacionRequest;
use App\Http\Requests\cotizacion\armadoCotizacion\UpdateArmadoCotizacionRequest;
// Repositories
use App\Repositories\cotizacion\armadoCotizacion\ArmadoCotizacionRepositories;
use App\Repositories\almacen\producto\ProductoRepositories;
class ArmadoCotizacionController extends Controller {
  protected $armadoCotizacionRepo;
  protected $productoRepo;

  public function __construct(ArmadoCotizacionRepositories $armadoCotizacionRepositories, ProductoRepositories $productoRepositories) {
    $this->armadoCotizacionRepo = $armadoCotizacionRepositories;
    $this->productoRepo         = $productoRepositories;
  }
  public function store(StoreArmadoCotizacionRequest $request, $id_cotizacion) {
    $this->armadoCotizacionRepo->store($request, $id_cotizacion);
    toastr()->success('¡Armado registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_armado) {
    $armado       = $this->armadoCotizacionRepo->armadoFindOrFailById($id_armado, ['direcciones', 'productos', 'cotizacion']);
    $direcciones  = $armado->direcciones()->paginate(99999999);
    $productos    = $armado->productos()->paginate(99999999);
    return view('cotizacion.armado_cotizacion.cot_arm_show', compact('armado', 'direcciones', 'productos'));
  }
  public function edit($id_armado) {
    $armado       = $this->armadoCotizacionRepo->armadoFindOrFailById($id_armado, ['direcciones', 'productos', 'cotizacion']);
    $this->armadoCotizacionRepo->verificarElEstatusDeLaCotizacion($armado->cotizacion->estat);
    $direcciones  = $armado->direcciones()->paginate(99999999);
    $productos    = $armado->productos()->paginate(99999999);
    $productos_list = $this->productoRepo->getAllSustitutosOrProductosMenos($armado->productos, 'copia');
    $stock_armado = $this->armadoCotizacionRepo->getStockArmado($armado);
    // $this->disminuirStockArmados();
    return view('cotizacion.armado_cotizacion.cot_arm_edit', compact('armado', 'direcciones', 'productos', 'productos_list', 'stock_armado'));
  }
  public function update(UpdateArmadoCotizacionRequest $request, $id_armado) {
    $this->armadoCotizacionRepo->update($request, $id_armado);
    toastr()->success('¡Armado actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_cotizacion) {
    $this->armadoCotizacionRepo->destroy($id_cotizacion);
    toastr()->success('¡Armado eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function clonar($id_armado) { 
    $respuesta = $this->armadoCotizacionRepo->clonar($id_armado);
    if($respuesta == false) {
      toastr()->error('¡Este armado no se puede clonar!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return back();
    }
    toastr()->success('¡Armado clonado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }

}