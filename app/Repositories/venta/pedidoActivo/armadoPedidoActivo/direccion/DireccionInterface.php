<?php
namespace App\Repositories\venta\pedidoActivo\armadoPedidoActivo\direccion;

interface DireccionInterface {
  public function direccionFindOrFailById($id_direccion, $relaciones);

  public function update($request, $id_direccion);

  public function updateTarjeta($request, $id_direccion);

  // public function updateCantidad($request, $id_direccion, $id_armado);
  
  public function estatusDireccionesDetalladas($cant_direccion, $armado, $ya_se_habia_cargado);

  // public function destroy($id_direccion);
}