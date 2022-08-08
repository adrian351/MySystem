<?php
namespace App\Http\Controllers\Usuario;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\usuario\StoreUsuarioRequest;
use App\Http\Requests\usuario\UpdateUsuarioRequest;
// Repositories
use App\Repositories\usuario\UsuarioRepositories;
use  App\Repositories\sistema\plantilla\PlantillaRepositories;
use App\Repositories\rol\rol\RolRepositories;
use App\Repositories\sistema\sistema\SistemaRepositories;

use App\Repositories\servicio\archivoGenerado\ArchivoGeneradoRepositories;
class UsuarioController extends Controller {
  protected $usuarioRepo;
  protected $plantillaRepo;
  protected $rolRepo;
  protected $sistemaRepo;
  public function __construct(UsuarioRepositories $usuarioRepositories, PlantillaRepositories $plantillaRepositories, RolRepositories $rolRepositories, SistemaRepositories $sistemaRepositories) { // Interfaz para implementar solo [metodos] o [metodos y cache] definido en AppServiceProvider
    $this->usuarioRepo    = $usuarioRepositories;
    $this->plantillaRepo  = $plantillaRepositories;
    $this->rolRepo        = $rolRepositories;
    $this->sistemaRepo    = $sistemaRepositories;
  }
  public function index(Request $request) {
    $usuarios = $this->usuarioRepo->getPagination($request, '1');
    return view('usuario.usu_index', compact('usuarios'));
  }
  public function create() {
    $roles = $this->rolRepo->getAllRolesPluckMenos(config('app.rol_cliente'));
    $plantillas = $this->plantillaRepo->getAllPlantillasModuloPluck('Usuarios (Bienvenida)');
    $plantilla_default = $this->sistemaRepo->datos('plant_usu_bien');
    return view('usuario.usu_create', compact('roles', 'plantillas', 'plantilla_default'));
  }
  public function store(StoreUsuarioRequest $request) {
    $this->usuarioRepo->store($request);
    toastr()->success('¡Usuario registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_usuario) {
    $usuario = $this->usuarioRepo->usuarioAsignadoFindOrFailById($id_usuario, '1', []);
    return view('usuario.usu_show', compact('usuario'));
  }
  public function edit($id_usuario) {
    $usuario = $this->usuarioRepo->usuarioAsignadoFindOrFailById($id_usuario, '1', []);
    $roles = $this->rolRepo->getAllRolesPluckMenos(config('app.rol_cliente'));
    return view('usuario.usu_edit', compact('usuario', 'roles'));
  }
  public function update(UpdateUsuarioRequest $request, $id_usuario) {
    $usuario = $this->usuarioRepo->update($request, $id_usuario);
    toastr()->success('¡Usuario actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_usuario) {
    $this->usuarioRepo->destroy($id_usuario);
    toastr()->success('¡Usuario eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function reEnviarCorreoBienvenida($id_usuario) {
    $ya_accedio = $this->usuarioRepo->reEnviarCorreoBienvenida($id_usuario);
    if($ya_accedio == true) {
      toastr()->error('¡No pueden enviar de nuevo el correo ya que el usuario ya ha accedido a la plataforma!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return back();
    }
    toastr()->success('¡Correo enviado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function getDatosFiscalesCliente(Request $request, $id_cliente) {
    if($request->ajax()) {
      $usuario        = $this->usuarioRepo->getUsuarioFindOrFail($id_cliente, ['datosFiscales']);
      $datosFiscales  = $usuario->datosFiscales;
  //  $datosFiscales = [];
  //    array_push($datosFiscales->items, ['id'=>'', 'rfc'=>'Seleccione. . .']);
      return response()->json($datosFiscales);
    }
  }

  public function UsuariosXLSXExport(ArchivoGeneradoRepositories $archivoGeneradoRepo) {
    return (new \App\Exports\usuarioYCliente\UsuariosXLSXExport)->download('Usuarios-'.date('Y-m-d').'.xlsx');
  }

}