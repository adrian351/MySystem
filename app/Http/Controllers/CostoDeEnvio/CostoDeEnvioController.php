<?php
namespace App\Http\Controllers\CostoDeEnvio;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use  App\Http\Requests\costoDeEnvio\StoreCostoDeEnvioRequest;
use  App\Http\Requests\costoDeEnvio\UpdateCostoDeEnvioRequest;
// Repositories
use App\Repositories\costoDeEnvio\CostoDeEnvioRepositories;

class CostoDeEnvioController extends Controller {
  protected $costoDeEnvioRepo;
  public function __construct(CostoDeEnvioRepositories $costoDeEnvioRepositories) {
    $this->costoDeEnvioRepo    = $costoDeEnvioRepositories;
  }
  public function index(Request $request) {
    $costos_de_envio = $this->costoDeEnvioRepo->getPagination($request);
    return view('costo_de_envio.cos_index', compact('costos_de_envio'));
  }
  public function create() {
    return view('costo_de_envio.cos_create');
  }
  public function store(StoreCostoDeEnvioRequest $request) {
    $costo_de_envio = $this->costoDeEnvioRepo->store($request);
    return $costo_de_envio;
  }
  public function show($id_costo) {
    $costo_de_envio = $this->costoDeEnvioRepo->costoDeEnvioAsignadoFindOrFailById($id_costo);
    return view('costo_de_envio.cos_show', compact('costo_de_envio'));
  }
  public function edit($id_costo) {
    $costo_de_envio = $this->costoDeEnvioRepo->costoDeEnvioAsignadoFindOrFailById($id_costo);
    return view('costo_de_envio.cos_edit', compact('costo_de_envio'));
  }
  public function update(UpdateCostoDeEnvioRequest $request, $id_costo) {
    $costo_de_envio = $this->costoDeEnvioRepo->update($request, $id_costo);
    return $costo_de_envio;
  }
  public function destroy($id_costo) {
    $this->costoDeEnvioRepo->destroy($id_costo);
    toastr()->success('¡Costo de envío eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function obtener(Request $request) {
    if($request->ajax()) {
      return $this->costoDeEnvioRepo->obtener($request);
    } else {
      return view('home');
    }
  }
}