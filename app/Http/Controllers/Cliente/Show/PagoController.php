<?php
namespace App\Http\Controllers\Cliente\Show;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\usuario\UsuarioRepositories;

class PagoController extends Controller {
  protected $usuarioRepo;
  public function __construct( UsuarioRepositories $usuarioRepositories) {
    $this->usuarioRepo = $usuarioRepositories;
  }
  public function index(Request $request, $id_cliente) {
    $cliente  = $this->usuarioRepo->usuarioAsignadoFindOrFailById($id_cliente, '2', ['pagos']);
    $pagos    = $cliente->pagos()->with('pedido')->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
    return view('cliente.show.pago.sho_pag_index', compact('cliente', 'pagos'));
  }
}