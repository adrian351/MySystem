<?php
namespace App\Http\Controllers\RolFerro\Envio;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\rolFerro\envio\local\UpdateEnvioLocalRequest;
// Repositories
use App\Repositories\rolFerro\envio\local\EnvioLocalRepositories;
use App\Repositories\rolFerro\ruta\RutaRepositories;

class EnvioForaneoController extends Controller {
  protected $envioLocalRepo;
  protected $rutaRepo;
  public function __construct(EnvioLocalRepositories $envioLocalRepositories, RutaRepositories $rutaRepositories) {
    $this->envioLocalRepo = $envioLocalRepositories;
    $this->rutaRepo       = $rutaRepositories;
  }
  public function index(Request $request) {
    $envios = $this->envioLocalRepo->getPagination($request, 'Foráneo', []);
    return view('rolFerro.envio.foraneo.efor_index', compact('envios'));
  }
  public function edit($id_envio) {
    $envio = $this->envioLocalRepo->envioFindOrFailById($id_envio, 'Foráneo', []);
    $rutas = $this->rutaRepo->allRutasPlunk();
    return view('rolFerro.envio.foraneo.efor_edit', compact('envio', 'rutas'));
  }
  public function update(UpdateEnvioLocalRequest $request, $id_envio) {
    $this->envioLocalRepo->update($request, $id_envio, 'Foráneo', 'Envios foráneos (Rol Ferro)', 'rolFerro.envioForaneo.show');
    toastr()->success('¡Envio actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function generarReporteDeForaneos() {
    return (new \App\Exports\rolFerro\envio\generarReporteDeEnviosForaneosExport)->download('ReporteDeEnviosForaneos-'.date('Y-m-d').'.xlsx');
  }
}