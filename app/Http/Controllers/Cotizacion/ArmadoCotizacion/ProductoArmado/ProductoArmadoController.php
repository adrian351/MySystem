<?php
namespace App\Http\Controllers\Cotizacion\ArmadoCotizacion\ProductoArmado;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\cotizacion\armadoCotizacion\productoArmado\StoreProductoArmadoRequest;
use App\Http\Requests\cotizacion\armadoCotizacion\productoArmado\UpdateCantidadRequest;
use App\Http\Requests\cotizacion\armadoCotizacion\productoArmado\UpdateUtilidadRequest;
// Repositories
use App\Repositories\cotizacion\armadoCotizacion\productoArmado\ProductoArmadoRepositories;

class ProductoArmadoController extends Controller {
  protected $productoArmadoRepo;
  public function __construct(ProductoArmadoRepositories $productoArmadoRepositories) {
    $this->productoArmadoRepo  = $productoArmadoRepositories;
  }
  public function store(StoreProductoArmadoRequest $request, $id_armado) {
    // dd($request);
    $this->productoArmadoRepo->store($request, $id_armado);
    toastr()->success('¡Producto registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_armado) {
    $this->productoArmadoRepo->destroy($id_armado);
    toastr()->success('¡Producto eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function updateCantidad(UpdateCantidadRequest $request, $id_producto) {
    $this->productoArmadoRepo->updateCantidad($request, $id_producto);
  //  toastr()->success('¡Cantidad de productos actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function updateUtilidad(UpdateUtilidadRequest $request, $id_producto) {
    $this->productoArmadoRepo->updateUtilidad($request, $id_producto);
  //  toastr()->success('¡Cantidad de productos actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}