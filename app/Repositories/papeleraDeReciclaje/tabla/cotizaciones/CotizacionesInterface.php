<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\cotizaciones;

interface CotizacionesInterface {
  public function metodo($metodo, $consulta);

  public function metDestroy($consulta);
}