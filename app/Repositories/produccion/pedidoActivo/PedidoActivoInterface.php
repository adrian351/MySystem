<?php
namespace App\Repositories\produccion\pedidoActivo;

interface PedidoActivoInterface {
  public function getPagination($request, $relaciones, $opc_consulta);
  
  public function pedidoActivoProduccionFindOrFailById($id_pedido, $relaciones, $accion);

  public function update($request, $id_pedido);
  
  public function getArmadosPedidoPaginate($pedido, $request);

  public function getPendientes();
}