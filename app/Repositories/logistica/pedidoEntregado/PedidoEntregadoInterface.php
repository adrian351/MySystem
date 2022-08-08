<?php
namespace App\Repositories\logistica\pedidoEntregado;

interface PedidoEntregadoInterface {
  public function pedidoEntregadoFindOrFailById($id_pedido);

  public function getPagination($request, $relaciones);

  public function getArmadosPedidoPaginate($pedido, $request);
}