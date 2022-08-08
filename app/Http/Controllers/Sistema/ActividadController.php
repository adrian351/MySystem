<?php
namespace App\Http\Controllers\Sistema;
use App\Http\Controllers\Controller;
use App\Models\Actividades;
// Request
use Illuminate\Http\Request;
// Interfaces
use App\Repositories\sistema\actividad\ActividadRepositories;

class ActividadController extends Controller {
  protected $actividadRepo;
  public function __construct(ActividadRepositories $actividadRepositories) { // Interfaz para implementar solo [metodos]
    $this->actividadRepo = $actividadRepositories;
  }
  public function index(Request $request) {
    $actividades = $this->actividadRepo->getPagination($request);
    return view('sistema.actividad.sis_act_index', compact('actividades'));
  }

}