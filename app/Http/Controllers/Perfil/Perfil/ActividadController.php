<?php
namespace App\Http\Controllers\Perfil\Perfil;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\perfil\perfil\actividad\ActividadRepositories;

class ActividadController extends Controller {
  protected $actividadRepo;
  public function __construct(ActividadRepositories $actividadRepositories) { // Interfaz para implementar solo [metodos] o [metodos y cache] definido en AppServiceProvider
    $this->actividadRepo = $actividadRepositories;
  }
  public function index(Request $request) {
    $actividades = $this->actividadRepo->getPagination($request);
    return view('perfil.perfil.actividad.per_per_index', compact('actividades'));
  }
}