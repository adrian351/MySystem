<?php
namespace App\Http\Controllers\PapeleraDeReciclaje;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;

class PapeleraDeReciclajeController extends Controller {
  protected $papeleraRepo;
  public function __construct(PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) { // Interfaz para implementar solo [metodos] o [metodos y cache] definido en AppServiceProvider
    $this->papeleraRepo = $papeleraDeReciclajeRepositories;
  }
  public function index(Request $request) {
    $registros = $this->papeleraRepo->getPagination($request);
    return view('papelera_de_reciclaje.pdr_index', compact('registros'));
  }
  public function destroy($id_registro) {
    $this->papeleraRepo->destroy($id_registro);
    toastr()->success('¡Registro eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function restore($id_registro) {
    $papelera = $this->papeleraRepo->restore($id_registro);
    if($papelera == false) {
      toastr()->error('¡No puedes restaurar este registro!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    } else {
      toastr()->success('¡Registro restaurado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    }
    return back();
  }
}