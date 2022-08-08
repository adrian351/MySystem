<?php
namespace App\Http\Controllers\QuejasYSugerencias;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\quejaYSugerencia\StoreQuejaYSugerenciaRequest;
// Repositories
use App\Repositories\quejasYSugerencias\QuejasYSugerenciasRepositories;

class QuejasYSugerenciasController extends Controller {
  protected $quejasYSugerenciasRepo;
  public function __construct(QuejasYSugerenciasRepositories $quejasYSugerenciasRepositories) {
    $this->quejasYSugerenciasRepo    = $quejasYSugerenciasRepositories;
  }
  public function index(Request $request) {
    $quejas_y_sugerencias = $this->quejasYSugerenciasRepo->getPagination($request);
    return view('queja_y_sugerencia.qsu_index', compact('quejas_y_sugerencias'));
  }
  public function create() {
    return view('queja_y_sugerencia.qsu_create');
  }
  public function store(StoreQuejaYSugerenciaRequest $request) {
    $this->quejasYSugerenciasRepo->store($request);
    toastr()->success('¡Queja y sugerencia enviada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_qys) {
    $queja_y_sugerencia = $this->quejasYSugerenciasRepo->qYSFindOrFailById($id_qys, ['usuario', 'archivos']);
    $archivos           = $queja_y_sugerencia->archivos()->paginate(99999999);
    return view('queja_y_sugerencia.qsu_show', compact('queja_y_sugerencia', 'archivos'));
  }
}