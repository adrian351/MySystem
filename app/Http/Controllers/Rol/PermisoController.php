<?php
namespace App\Http\Controllers\Rol;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\rol\permiso\PermisoRepositories;

class PermisoController extends Controller {
  protected $permisoRepo;
  public function __construct(PermisoRepositories $permisoRepositories) {
    $this->permisoRepo = $permisoRepositories;
  }
  public function index(Request $request) {
    $permisos = $this->permisoRepo->getPagination($request);
    return view('rol.permiso.rol_per_index', compact('permisos'));
  }
  public function show($id_permiso) {
    $permiso = $this->permisoRepo->rolFindOrFailById($id_permiso);
    return view('rol.permiso.rol_per_show', compact('permiso'));
  }
} 