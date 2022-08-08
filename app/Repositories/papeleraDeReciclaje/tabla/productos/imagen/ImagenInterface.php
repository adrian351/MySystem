<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\productos\imagen;

interface ImagenInterface {
  public function metodo($metodo, $consulta);

  public function metDestroy($consulta);
}