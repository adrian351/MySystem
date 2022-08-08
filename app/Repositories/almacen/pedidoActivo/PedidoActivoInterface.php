<?php
namespace App\Repositories\almacen\pedidoActivo;

interface PedidoActivoInterface {
  public function pedidoActivoAlmacenFindOrFailById($id_pedido, $relaciones);

  public function getPagination($request, $relaciones, $opc_consulta);

  public function update($request, $id_pedido);

  public function getArmadosPedidoPaginate($pedido, $request);

  public function marcarTodoCompleto($id_pedido);

  public function getPendientes();

  public function getAllPedidosPlunk();
}