<?php
namespace App\Repositories\logistica\direccionLocal;

interface EstatusArmadonInterface {
  public function estatusArmado($direccion);

  public function regresarAProduccion($armado);
}