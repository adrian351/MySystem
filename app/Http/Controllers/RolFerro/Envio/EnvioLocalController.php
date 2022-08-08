<?php
namespace App\Http\Controllers\RolFerro\Envio;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\rolFerro\envio\local\UpdateEnvioLocalRequest;
// Repositories
use App\Repositories\rolFerro\envio\local\EnvioLocalRepositories;
use App\Repositories\rolFerro\ruta\RutaRepositories;

class EnvioLocalController extends Controller {
  protected $envioLocalRepo;
  protected $rutaRepo;
  public function __construct(EnvioLocalRepositories $envioLocalRepositories, RutaRepositories $rutaRepositories) {
    $this->envioLocalRepo = $envioLocalRepositories;
    $this->rutaRepo       = $rutaRepositories;
  }
  public function index(Request $request) {
    $envios = $this->envioLocalRepo->getPagination($request, 'Local', []);
    return view('rolFerro.envio.local.eloc_index', compact('envios'));
  }
  public function edit($id_envio) {
    $envio = $this->envioLocalRepo->envioFindOrFailById($id_envio, 'Local', []);
    $rutas = $this->rutaRepo->allRutasPlunk();
    return view('rolFerro.envio.local.eloc_edit', compact('envio', 'rutas'));
  }
  public function update(UpdateEnvioLocalRequest $request, $id_envio) {
    $this->envioLocalRepo->update($request, $id_envio, 'Local', 'Envios locales (Rol Ferro)', 'rolFerro.envioLocal.show');
    toastr()->success('¡Envio actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function generarReporteDeLocales() {
    return (new \App\Exports\rolFerro\envio\generarReporteDeEnviosLocalesExport)->download('ReporteDeEnviosLocales-'.date('Y-m-d').'.xlsx');
  }
}