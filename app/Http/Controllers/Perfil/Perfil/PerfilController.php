<?php
namespace App\Http\Controllers\Perfil\Perfil;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\perfil\UpdatePerfilRequest;
// Repositories
use App\Repositories\perfil\perfil\perfil\PerfilRepositories;

class PerfilController extends Controller {
  protected $perfilRepo;
  public function __construct(PerfilRepositories $perfilRepositories) { // Interfaz para implementar solo [metodos] o [metodos y cache] definido en AppServiceProvider
    $this->perfilRepo = $perfilRepositories;
  }
  public function show() {
    return view('perfil.perfil.per_per_index');
  }
  public function edit() {
    return view('perfil.perfil.editar.per_per_edit');
  }
  public function update(UpdatePerfilRequest $request) {
    $this->perfilRepo->update($request);
    toastr()->success('¡Información actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}