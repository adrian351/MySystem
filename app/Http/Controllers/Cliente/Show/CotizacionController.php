<?php
namespace App\Http\Controllers\Cliente\Show;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\usuario\UsuarioRepositories;

class CotizacionController extends Controller {
  protected $usuarioRepo;
  public function __construct( UsuarioRepositories $usuarioRepositories) {
    $this->usuarioRepo  = $usuarioRepositories;
  }
  public function index(Request $request, $id_cliente) {
    $cliente      = $this->usuarioRepo->usuarioAsignadoFindOrFailById($id_cliente, '2', ['cotizaciones']);
    $cotizaciones = $cliente->cotizaciones()->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
    return view('cliente.show.cotizacion.sho_cot_index', compact('cliente', 'cotizaciones'));
  }
}