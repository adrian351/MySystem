<?php
namespace App\Repositories\almacen\pedidoActivo\armadoPedidoActivo;

interface ArmadoPedidoActivoInterface {
  public function armadoPedidoActivoFindOrFailById($id_armado, $relaciones, $accion);

  public function update($request, $id_armado);

  public function getArmadoPedidoTieneProductosPaginate($pedido, $request);

  public function armadosTerminadosAlmacen($id_pedido, $estatus);
}