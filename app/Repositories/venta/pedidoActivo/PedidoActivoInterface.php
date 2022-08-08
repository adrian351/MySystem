<?php
namespace App\Repositories\venta\pedidoActivo;

interface PedidoActivoInterface {
  public function pedidoAsignadoFindOrFailById($id_pedido, $relaciones);

  public function getPagination($request, $relaciones, $opc_consulta);

  public function update($request, $id_pedido);

  public function destroy($id_pedido);

  public function getArmadosPedidoPagination($pedido, $request);

  public function getMontoDePagosAprobados($pedido);

  public function getPagosPedidoPagination($pedido, $request);

  public function getPedidoFindOrFail($id_pedido, $relaciones);

  public function getEstatusPagoPedido($pedido);

  public function unificarPedido($pedido, $fecha_original, $fecha_nueva);

  public function eliminarUnificacionDelPedido($id_pedido);

  public function getPendientes();
}