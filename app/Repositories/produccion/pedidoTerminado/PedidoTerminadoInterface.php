<?php
namespace App\Repositories\produccion\pedidoTerminado;

interface PedidoTerminadoInterface {
  public function pedidoTerminadoFindOrFailById($id_pedido);
  
  public function getPagination($request, $relaciones);

  public function getArmadosPedidoPaginate($pedido, $request);
}