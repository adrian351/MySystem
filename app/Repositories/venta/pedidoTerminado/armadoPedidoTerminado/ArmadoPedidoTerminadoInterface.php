<?php
namespace App\Repositories\venta\pedidoTerminado\armadoPedidoTerminado;

interface ArmadoPedidoTerminadoInterface {
  public function armadoFindOrFailById($id_armado, $relaciones);
}