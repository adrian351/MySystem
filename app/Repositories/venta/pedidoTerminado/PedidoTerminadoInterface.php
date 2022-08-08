<?php
namespace App\Repositories\venta\pedidoTerminado;

interface PedidoTerminadoInterface {
  public function pedidoTerminadoFindOrFailById($id_pedido, $relaciones);
  
  public function getPagination($request, $relaciones, $opc_consulta);
}
