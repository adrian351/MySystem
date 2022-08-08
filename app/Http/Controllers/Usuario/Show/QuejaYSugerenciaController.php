<?php
namespace App\Http\Controllers\Usuario\Show;
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
  public function index(Request $request, $id_usuario) {
    $usuario              = $this->usuarioRepo->usuarioAsignadoFindOrFailById($id_usuario, '1', ['quejasYSugerencias']);
    $quejas_y_sugerencias = $usuario->quejasYSugerencias()->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
    return view('usuario.show.quejaYSugerencia.sho_qsu_index', compact('usuario', 'quejas_y_sugerencias'));
  }
}