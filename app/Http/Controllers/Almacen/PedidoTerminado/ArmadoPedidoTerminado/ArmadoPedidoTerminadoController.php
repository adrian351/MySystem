<?php
namespace App\Http\Controllers\Almacen\PedidoTerminado\ArmadoPedidoTerminado;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\almacen\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class ArmadoPedidoTerminadoController extends Controller {
  protected $serviceCrypt;
  protected $armadoPedidoActivoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories) {
    $this->serviceCrypt           = $serviceCrypt;
    $this->armadoPedidoActivoRepo = $armadoPedidoActivoRepositories;
  }
  public function show(Request $request, $id_armado) {
    $armado     = $this->armadoPedidoActivoRepo->armadoPedidoActivoFindOrFailById($id_armado, ['pedido', 'productos'], 'show');
    // Verifica si el pedido relacionado a este armado cumple con la fecha dentro del rango de visualizar
    $armado->pedido()->whereBetween('fech_estat_alm', [date("Y-m-d", strtotime('-90 day', strtotime(date("Y-m-d")))), date("Y-m-d", strtotime('+1 day', strtotime(date("Y-m-d"))))])->firstOrFail();
    $productos  = $armado->productos()->with(['sustitutos', 'productos_original'])->get();
    return view('almacen.pedido.pedido_terminado.armado_terminado.armTer_show', compact('armado', 'productos'));
  }
}