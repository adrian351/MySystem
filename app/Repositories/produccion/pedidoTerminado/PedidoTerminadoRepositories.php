<?php
namespace App\Repositories\produccion\pedidoTerminado;
// Models
use App\Models\Pedido;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class PedidoTerminadoRepositories implements PedidoTerminadoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function pedidoTerminadoFindOrFailById($id_pedido) {
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    $pedido = Pedido::with('armados')
    ->where('estat_produc', config('app.en_almacen_de_salida_terminado'))
    ->whereBetween('fech_estat_produc', [date("Y-m-d", strtotime('-90 day', strtotime(date("Y-m-d")))), date("Y-m-d", strtotime('+1 day', strtotime(date("Y-m-d"))))])
    ->findOrFail($id_pedido);
    return $pedido;
  }
  public function getPagination($request, $relaciones) {
    if($request->paginador == null) {
      $paginador = 50;
    }else {
      $paginador = $request->paginador;
    }

    return Pedido::with($relaciones)
    ->where('estat_produc', config('app.en_almacen_de_salida_terminado'))
    ->whereBetween('fech_estat_produc', [date("Y-m-d", strtotime('-90 day', strtotime(date("Y-m-d")))), date("Y-m-d", strtotime('+1 day', strtotime(date("Y-m-d"))))])
    ->buscar($request->opcion_buscador, $request->buscador)
    ->orderBy('fech_estat_produc', 'DESC')->paginate( $paginador);
  }
  public function getArmadosPedidoPaginate($pedido, $request) {
    if($request->opcion_buscador != null) {
      return $pedido->armados()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $pedido->armados()->paginate($request->paginador);
  }
}
