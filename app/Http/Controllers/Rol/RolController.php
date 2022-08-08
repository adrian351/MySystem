<?php
namespace App\Http\Controllers\Rol;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\rol\StoreRolRequest;
use App\Http\Requests\rol\UpdateRolRequest;
// Repositories
use App\Repositories\rol\rol\RolRepositories;
use App\Repositories\rol\permiso\PermisoRepositories;

class RolController extends Controller {
  protected $rolRepo;
  protected $permisoRepo;
  public function __construct(RolRepositories $rolRepositories, PermisoRepositories $permisoRepositories) {
    $this->rolRepo = $rolRepositories;
    $this->permisoRepo = $permisoRepositories;
  }
  public function index(Request $request) {
    $roles = $this->rolRepo->getPagination($request);
    return view('rol.rol.rol_rol_index', compact('roles'));
  }
  public function create() {
    $permisos = $this->permisoRepo->getAllPermissionsPluck();
    return view('rol.rol.rol_rol_create', compact('permisos'));
  }
  public function store(StoreRolRequest $request) {
    $this->rolRepo->store($request);
    toastr()->success('¡Rol registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_rol) {
    $rol = $this->rolRepo->rolAsignadoFindOrFailById($id_rol);
    return view('rol.rol.rol_rol_show', compact('rol'));
  }
  public function edit($id_rol) {
    $rol = $this->rolRepo->rolAsignadoFindOrFailById($id_rol);
    $permisos = $this->permisoRepo->getAllPermissionsPluck();
    return view('rol.rol.rol_rol_edit', compact('rol', 'permisos'));
  }
  public function update(UpdateRolRequest $request, $id_rol) {
    $this->rolRepo->update($request, $id_rol);
    toastr()->success('¡Rol actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_rol) {
    $this->rolRepo->destroy($id_rol);
    toastr()->success('¡Rol eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
} 