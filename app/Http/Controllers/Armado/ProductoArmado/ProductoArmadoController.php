<?php
namespace App\Http\Controllers\Armado\ProductoArmado;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\armado\productoArmado\StoreProductoArmadoRequest;
use App\Http\Requests\armado\productoArmado\UpdateCantidadRequest;
// Repositories
use App\Repositories\armado\productoArmado\ProductoArmadoRepositories;

class ProductoArmadoController extends Controller {
  protected $productoArmadoRepo;
  public function __construct(ProductoArmadoRepositories $productoArmadoRepositories) {
    $this->productoArmadoRepo  = $productoArmadoRepositories;
  }
  public function store(StoreProductoArmadoRequest $request, $id_armado) {
    $this->productoArmadoRepo->store($request, $id_armado);
    toastr()->success('¡Producto registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_armado, $id_producto) {
    $this->productoArmadoRepo->destroy($id_armado, $id_producto);
    toastr()->success('¡Producto eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function editCantidad(UpdateCantidadRequest $request, $id_producto, $id_armado) {
    $this->productoArmadoRepo->editCantidad($request, $id_producto, $id_armado);
    toastr()->success('¡Cantidad de productos actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}