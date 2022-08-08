<?php

namespace App\Http\Controllers\RolCliente\Comprobante;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\rolCliente\pedido\UpdatePedidoRequest;
// Repositories
use App\Repositories\rolCliente\pedido\PedidoClienteRepositories;
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;

class ComprobanteController extends Controller {
  protected $pedidoClienteRepo;
  protected $pedidoActivoRepo;
  public function __construct(PedidoClienteRepositories $pedidoClienteRepositories, PedidoActivoRepositories $pedidoActivoRepositories) {
    $this->pedidoClienteRepo  = $pedidoClienteRepositories;
    $this->pedidoActivoRepo   = $pedidoActivoRepositories;
  }
  public function index(Request $request) {
    $pedidos = $this->pedidoClienteRepo->getPagination($request);
    return view('rolCliente.comprobante.com_index', compact('pedidos'));
  }
  public function getFaltanteDePago(Request $request, $id_pedido) {
    if($request->ajax()) {
      $resultado = $this->pedidoClienteRepo->getFaltanteDePago($id_pedido);
      return $resultado;
    } else {
      return view('home');
    }
  }
}