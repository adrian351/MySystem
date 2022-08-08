<?php
namespace App\Http\Controllers\Almacen\Producto\Imagen;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\almacen\producto\imagen\StoreImagenRequest;
// Repositories
use App\Repositories\almacen\producto\imagen\ImagenRepositories;

class ImagenController extends Controller {
  protected $imagenRepo;
  public function __construct(ImagenRepositories $imagenRepositories) {
    $this->imagenRepo = $imagenRepositories;
  }
  public function store(StoreImagenRequest $request, $id_producto) {
    $this->imagenRepo->store($request, $id_producto);
    toastr()->success('¡Imagen(es) registrada(s) exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_producto) {
    $this->imagenRepo->destroy($id_producto);
    toastr()->success('¡Imagen eliminada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}