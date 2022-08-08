<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\manual;

interface ManualInterface {
  public function metodo($metodo, $consulta);

  public function metDestroy($consulta);
}