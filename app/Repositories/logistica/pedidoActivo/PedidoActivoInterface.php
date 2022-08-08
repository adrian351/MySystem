<?php
namespace App\Repositories\logistica\pedidoActivo;

interface PedidoActivoInterface {
  public function getPagination($request, $relaciones, $opc_consulta);
  
  public function pedidoActivoLogisticaFindOrFailById($id_pedido, $relaciones);

  public function update($request, $id_pedido);
  
  public function getArmadosPedidoPaginate($pedido, $request);
}