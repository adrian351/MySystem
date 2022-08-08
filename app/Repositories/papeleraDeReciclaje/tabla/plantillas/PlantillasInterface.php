<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\plantillas;

interface PlantillasInterface {
  public function metodo($metodo, $consulta);

  public function metDestroy($consulta);
}