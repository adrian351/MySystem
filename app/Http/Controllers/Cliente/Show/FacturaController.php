<?php
namespace App\Http\Controllers\Cliente\Show;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\usuario\UsuarioRepositories;

class FacturaController extends Controller {
  protected $usuarioRepo;
  public function __construct( UsuarioRepositories $usuarioRepositories) {
    $this->usuarioRepo = $usuarioRepositories;
  }
  public function index(Request $request, $id_cliente) {
    $cliente  = $this->usuarioRepo->usuarioAsignadoFindOrFailById($id_cliente, '2', ['facturas']);
    $facturas = $cliente->facturas()->buscar($request->opcion_buscador, $request->buscador)->orderByRaw('est_fact DESC, id DESC')->paginate($request->paginador);
    return view('cliente.show.factura.sho_fac_index', compact('cliente', 'facturas'));
  }
}