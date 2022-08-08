<?php
namespace App\Http\Controllers\Sistema;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\sistema\manual\StoreManualRequest;
use App\Http\Requests\sistema\manual\UpdateManualRequest;
// Repositories
use App\Repositories\sistema\manual\ManualRepositories;

class ManualController extends Controller {
  protected $manualRepo;
  public function __construct(ManualRepositories $manualRepositories) {
    $this->manualRepo = $manualRepositories;
  }
  public function index(Request $request) {
    $manuales = $this->manualRepo->getPagination($request);
    return view('sistema.manual.man_index', compact('manuales'));
  }
  public function create() {
    return view('sistema.manual.man_create');
  }
  public function store(StoreManualRequest $request) {
    $this->manualRepo->store($request);
    toastr()->success('¡Manual subido exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
	return back();
  }
  public function show($id_manual) {
    $manual = $this->manualRepo->manualFindOrFailById($id_manual);
    return view('sistema.manual.man_show', compact('manual'));
  }
  public function edit($id_manual) {
    $manual = $this->manualRepo->manualFindOrFailById($id_manual);
    return view('sistema.manual.man_edit', compact('manual',));
  }
  public function update(UpdateManualRequest $request, $id_manual) {
    $this->manualRepo->update($request, $id_manual);
    toastr()->success('¡Manual actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_manual) {
    $this->manualRepo->destroy($id_manual);
    toastr()->success('¡Manual eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}