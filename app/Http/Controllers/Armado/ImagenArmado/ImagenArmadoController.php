<?php
namespace App\Http\Controllers\Armado\ImagenArmado;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\armado\imagenArmado\StoreImagenArmadoRequest;
// Repositories
use App\Repositories\armado\imagenArmado\ImagenArmadoRepositories;

class ImagenArmadoController extends Controller {
  protected $imagenArmadoRepo;
  public function __construct(ImagenArmadoRepositories $imagenArmadoRepositories) {
    $this->imagenArmadoRepo = $imagenArmadoRepositories;
  }
  public function store(StoreImagenArmadoRequest $request, $id_armado) {
    $this->imagenArmadoRepo->store($request, $id_armado);
    toastr()->success('¡Imagen(es) registrada(s) exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_imagen) {
    $this->imagenArmadoRepo->destroy($id_imagen);
    toastr()->success('¡Imagen eliminada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}