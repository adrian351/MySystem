<?php
namespace App\Repositories\cotizacion;

interface CalcularValoresCotizacionInterface {
  public function calculaValoresCotizacion($cotizacion);

  public function calculaValoresCotizacionAlModificarProducto($producto);
}