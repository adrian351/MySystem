<?php
namespace App\Repositories\cotizacion;

interface AprobarCotizacionInterface {
  public function elPedidoEsDeRegalo($cotizacion, $armados_cotizacion);

  public function elPedidoTieneDireccionesForaneas($pedido, $armado_cotizacion, $modificado);

  public function sumaUnoALaUltimaLetraYArmadosCargados($pedido, $cantidad);
  
  public function sumaUnoALaUltimaLetraDireccionesCargadas($armado);
  
  public function aprobar($id_cotizacion);
}