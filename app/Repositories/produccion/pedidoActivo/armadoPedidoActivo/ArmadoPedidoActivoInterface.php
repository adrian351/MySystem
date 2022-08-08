<?php
namespace App\Repositories\produccion\pedidoActivo\armadoPedidoActivo;

interface ArmadoPedidoActivoInterface {
  public function armadoPedidoActivoFindOrFailById($id_armado, $relaciones, $accion);

  public function update($request, $id_armado);

  public function armadosTerminadosProduccion($id_pedido, $estatus);

  public function getArmadoPedidoTieneDireccionesPaginate($armado, $request);

  public function updateModal($request, $id_armado);
}