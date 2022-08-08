<?php
namespace App\Http\Controllers\MetodoDeEntrega\TipoDeEnvio;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\metodoDeEntrega\tipoDeEnvio\TipoDeEnvioRepositories;
use App\Repositories\metodoDeEntrega\MetodoDeEntregaRepositories;

class TipoDeEnvioController extends Controller {
  protected $tipoDeEnvioRepo;
  protected $metodoDeEntregaRepo;
  public function __construct(TipoDeEnvioRepositories $tipoDeEnvioRepositories, MetodoDeEntregaRepositories $metodoDeEntregaRepositories) {
    $this->tipoDeEnvioRepo    = $tipoDeEnvioRepositories;
    $this->metodoDeEntregaRepo    = $metodoDeEntregaRepositories;
  }
  public function getTiposDeEnvio(Request $request, $met_de_entrega) {
    if($request->ajax()) {
      $metodo_de_entrega = $this->metodoDeEntregaRepo->metodoFindOrFailByNombreMetodo($met_de_entrega, []);
      $tipos_de_envio = $this->tipoDeEnvioRepo->getAllTiposDeEnvioPluck($metodo_de_entrega->id);
      return $tipos_de_envio;
    }
  }
}