<?php
namespace App\Http\Controllers\Estado;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\estado\EstadoRepositories;

class EstadoController extends Controller {
  protected $estadoRepo;
  public function __construct(EstadoRepositories $estadoRepositories) {
    $this->estadoRepo    = $estadoRepositories;
  }
  public function getEstados(Request $request, $foraneo_o_local) {
    if($request->ajax()) {
      $estados = $this->estadoRepo->getEstadosForaneosOLocalesPluck($foraneo_o_local);
      return $estados;
    }
  }
}