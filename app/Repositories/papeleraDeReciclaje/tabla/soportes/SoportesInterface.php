<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\soportes;

interface SoportesInterface {
  public function metodo($metodo, $consulta);

  public function metDestroy($consulta);
}