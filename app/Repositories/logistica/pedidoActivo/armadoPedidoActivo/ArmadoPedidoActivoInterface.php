<?php
namespace App\Repositories\logistica\pedidoActivo\armadoPedidoActivo;

interface ArmadoPedidoActivoInterface {
  public function armadoPedidoActivoFindOrFailById($id_armado, $relaciones, $accion);

  public function update($request, $id_armado);

  public function armadosTerminadosLogistica($id_pedido, $estatus);

  public function getArmadoPedidoTieneDireccionesPaginate($armado, $request);
}