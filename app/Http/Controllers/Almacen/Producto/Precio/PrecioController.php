<?php
namespace App\Http\Controllers\Almacen\Producto\Precio;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\almacen\producto\precio\StorePrecioRequest;
// Repositories
use App\Repositories\almacen\producto\ProductoRepositories;
use App\Repositories\almacen\producto\precio\PrecioRepositories;

class PrecioController extends Controller {
  protected $precioRepo;
  protected $productoRepo;
  public function __construct(PrecioRepositories $precioRepositories, ProductoRepositories $productoRepositories) {
    $this->precioRepo   = $precioRepositories;
    $this->productoRepo = $productoRepositories;
  }
  public function create($id_producto) {
    $producto =  $this->productoRepo->getproductoFindOrFailById($id_producto, []);
    return view('almacen.producto.precios.pre_create', compact('producto'));
  }
  public function store(StorePrecioRequest $request, $id_producto) {
    $this->precioRepo->store($request, $id_producto);
    toastr()->success('¡Precio registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_precio) {
    $this->precioRepo->destroy($id_precio);
    toastr()->success('¡Precio eliminado exitosamenste!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}