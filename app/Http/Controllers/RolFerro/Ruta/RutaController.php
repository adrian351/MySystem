<?php
namespace App\Http\Controllers\RolFerro\Ruta;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\rolFerro\ruta\StoreRutaRequest;
use App\Http\Requests\rolFerro\ruta\UpdateRutaRequest;
// Repositories
use App\Repositories\rolFerro\ruta\RutaRepositories;

class RutaController extends Controller {
  protected $rutaRepo;
  public function __construct(RutaRepositories $rutaRepositories) {
    $this->rutaRepo = $rutaRepositories;
  }
  public function index(Request $request) {
    $rutas = $this->rutaRepo->getPagination($request);
    return view('rolFerro.ruta.rut_index', compact('rutas'));
  }
  public function create() {
    return view('rolFerro.ruta.rut_create');
  }
  public function store(StoreRutaRequest $request) {
    $this->rutaRepo->store($request);
    toastr()->success('¡Ruta registrada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
	return back();
  }
  public function show($id_ruta) {
    $ruta = $this->rutaRepo->rutaFindOrFailById($id_ruta, []);
    return view('rolFerro.ruta.rut_show', compact('ruta'));
  }
  public function edit($id_ruta) {
    $ruta = $this->rutaRepo->rutaFindOrFailById($id_ruta, []);
    return view('rolFerro.ruta.rut_edit', compact('ruta',));
  }
  public function update(UpdateRutaRequest $request, $id_ruta) {
    $this->rutaRepo->update($request, $id_ruta);
    toastr()->success('¡Ruta actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_ruta) {
    $this->rutaRepo->destroy($id_ruta);
    toastr()->success('¡Ruta eliminada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}