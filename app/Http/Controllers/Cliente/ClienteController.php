<?php
namespace App\Http\Controllers\Cliente;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\usuario\StoreUsuarioRequest;
use App\Http\Requests\usuario\UpdateUsuarioRequest;
// Repositories
use App\Repositories\cliente\ClienteRepositories;
use App\Repositories\usuario\UsuarioRepositories;
use  App\Repositories\sistema\plantilla\PlantillaRepositories;
use App\Repositories\rol\rol\RolRepositories;
use App\Repositories\sistema\sistema\SistemaRepositories;

class ClienteController extends Controller {
  protected $clienteRepo;
  protected $usuarioRepo;
  protected $plantillaRepo;
  protected $rolRepo;
  protected $sistemaRepo;
  public function __construct(ClienteRepositories $clienteRepositories, UsuarioRepositories $usuarioRepositories, PlantillaRepositories $plantillaRepositories, RolRepositories $rolRepositories, SistemaRepositories $sistemaRepositories) {
    $this->clienteRepo    = $clienteRepositories;
    $this->usuarioRepo    = $usuarioRepositories;
    $this->plantillaRepo  = $plantillaRepositories;
    $this->rolRepo        = $rolRepositories;
    $this->sistemaRepo    = $sistemaRepositories;
  }
  public function index(Request $request) {
    $clientes = $this->usuarioRepo->getPagination($request, '2');
    return view('cliente.cli_index', compact('clientes'));
  }
  public function create() {
    $roles = $this->rolRepo->getSoloDosRolesPluck(config('app.rol_sin_acceso_al_sistema'), config('app.rol_cliente'));
    $plantillas = $this->plantillaRepo->getAllPlantillasModuloPluck('Clientes (Bienvenida)');
    $plantilla_default = $this->sistemaRepo->datos('plant_cli_bien');
    return view('cliente.cli_create', compact('roles', 'plantillas', 'plantilla_default'));
  }
  public function store(StoreUsuarioRequest $request) {
    $this->clienteRepo->store($request);
    toastr()->success('¡Cliente registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_cliente) {
    $cliente = $this->usuarioRepo->usuarioAsignadoFindOrFailById($id_cliente, '2', []);
    return view('cliente.cli_show', compact('cliente'));
  }
  public function edit($id_cliente) {
    $cliente = $this->usuarioRepo->usuarioAsignadoFindOrFailById($id_cliente, '2', []);
    $roles = $this->rolRepo->getSoloDosRolesPluck(config('app.rol_sin_acceso_al_sistema'), config('app.rol_cliente'));
    return view('cliente.cli_edit', compact('cliente', 'roles'));
  }
  public function update(UpdateUsuarioRequest $request, $id_cliente) {
    $this->clienteRepo->update($request, $id_cliente);
    toastr()->success('¡Cliente actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_cliente) {
    $this->clienteRepo->destroy($id_cliente);
    toastr()->success('¡Cliente eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function reEnviarCorreoBienvenida($id_cliente) {
    $ya_accedio = $this->clienteRepo->reEnviarCorreoBienvenida($id_cliente);
    if($ya_accedio == true) {
      toastr()->error('¡No pueden enviar de nuevo el correo ya que el cliente ya ha accedido a la plataforma!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return back();
    }
    toastr()->success('¡Correo enviado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}