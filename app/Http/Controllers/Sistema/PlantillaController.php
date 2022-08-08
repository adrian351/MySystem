<?php
namespace App\Http\Controllers\Sistema;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\sistema\plantilla\StorePlantillaRequest;
use App\Http\Requests\sistema\plantilla\UpdatePlantillaRequest;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\sistema\plantilla\PlantillaRepositories;

class PlantillaController extends Controller {
  protected $serviceCrypt;
  protected $plantillaRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PlantillaRepositories $plantillaRepositories) { // Interfaz para implementar solo [metodos] o [metodos y cache] definido en AppServiceProvider
    $this->serviceCrypt   = $serviceCrypt;
    $this->plantillaRepo  = $plantillaRepositories;
  }
  public function index(Request $request) {
    $plantillas = $this->plantillaRepo->getPagination($request);
    return view('sistema.plantilla.sis_pla_index', compact('plantillas'));
  }
  public function create() {
  	return view('sistema.plantilla.sis_pla_create');
  }
  public function store(StorePlantillaRequest $request) {
    $plantilla = $this->plantillaRepo->store($request);
    if(auth()->user()->can('sistema.plantilla.edit')) {
      toastr()->success('¡Plantilla registrada exitosamente ahora puedes realizar el diseño!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return redirect(route('sistema.plantilla.edit', $this->serviceCrypt->encrypt($plantilla->id))); 
    }
    toastr()->success('¡Plantilla registrada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_plantilla) {
    $plantilla = $this->plantillaRepo->plantillaAsignadoFindOrFailById($id_plantilla);
    return view('sistema.plantilla.sis_pla_show', compact('plantilla'));
  }
  public function edit($id_plantilla) {
    $plantilla = $this->plantillaRepo->plantillaAsignadoFindOrFailById($id_plantilla);
    return view('sistema.plantilla.sis_pla_edit', compact('plantilla'));
  }
  public function update(UpdatePlantillaRequest $request, $id_plantilla) {
    $this->plantillaRepo->update($request, $id_plantilla);
    toastr()->success('¡Plantilla actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_plantilla) {
    $this->plantillaRepo->destroy($id_plantilla);
    toastr()->success('¡Plantilla eliminada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}