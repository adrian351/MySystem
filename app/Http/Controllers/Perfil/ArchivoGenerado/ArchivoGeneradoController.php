<?php
namespace App\Http\Controllers\Perfil\ArchivoGenerado;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\perfil\archivoGenerado\ArchivoGeneradoRepositories;

class ArchivoGeneradoController extends Controller {
  protected $archivoGeneradoRepo;
  public function __construct(ArchivoGeneradoRepositories $archivoGeneradoRepositories) {
    $this->archivoGeneradoRepo     = $archivoGeneradoRepositories;
    $this->middleware('RolDiferenteAlCliente');
  }
  public function index(Request $request) {
    $archivos_generados = $this->archivoGeneradoRepo->getPagination($request);
    return view('perfil.archivoGenerado.per_arcGen_index', compact('archivos_generados'));
    ;
  }
}