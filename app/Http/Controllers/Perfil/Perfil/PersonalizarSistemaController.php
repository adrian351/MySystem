<?php
namespace App\Http\Controllers\Perfil\Perfil;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\perfil\UpdatePersonalizarRequest;
// Repositories
use App\Repositories\perfil\perfil\personalizar\PersonalizarRepositories;

class PersonalizarSistemaController extends Controller {
  protected $personalizarRepo;
  public function __construct(PersonalizarRepositories $personalizarRepositories) { // Interfaz para implementar solo [metodos] o [metodos y cache] definido en AppServiceProvider
    $this->personalizarRepo = $personalizarRepositories;
  }
  public function edit() {
    return view('perfil.perfil.personalizar.per_per_edit');
  }
  public function update(UpdatePersonalizarRequest $request) {
    $this->personalizarRepo->update($request);
    toastr()->success('¡Personalización guardada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}