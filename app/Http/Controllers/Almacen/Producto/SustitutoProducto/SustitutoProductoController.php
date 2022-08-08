<?php
namespace App\Http\Controllers\Almacen\Producto\SustitutoProducto;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\almacen\producto\sustitutoProducto\StoreSustitutoRequest;
// Repositories
use App\Repositories\almacen\producto\sustitutoProducto\SustitutoProductoRepositories;

class SustitutoProductoController extends Controller {
  protected $sustitutoProductoRepo;
  public function __construct(SustitutoProductoRepositories $sustitutoProductoRepositories) {
    $this->sustitutoProductoRepo = $sustitutoProductoRepositories;
  }
  public function store(StoreSustitutoRequest $request, $id_producto) {
    $this->sustitutoProductoRepo->store($request, $id_producto);
    toastr()->success('¡Sustituto registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_producto, $id_sustituto) {
    $this->sustitutoProductoRepo->destroy($id_producto, $id_sustituto);
    toastr()->success('¡Sustituto eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}