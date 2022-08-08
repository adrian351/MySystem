<?php
namespace App\Http\Controllers\Cliente\Show;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\usuario\UsuarioRepositories;

class QuejaYSugerenciaController extends Controller {
  protected $usuarioRepo;
  public function __construct( UsuarioRepositories $usuarioRepositories) {
    $this->usuarioRepo    = $usuarioRepositories;
  }
  public function index(Request $request, $id_cliente) {
    $cliente              = $this->usuarioRepo->usuarioAsignadoFindOrFailById($id_cliente, '2', ['quejasYSugerencias']);
    $quejas_y_sugerencias = $cliente->quejasYSugerencias()->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
    return view('cliente.show.quejaYSugerencia.sho_qsu_index', compact('cliente', 'quejas_y_sugerencias'));
  }
}