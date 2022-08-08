<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\quejasYSugerencias;

interface QuejasYSugerenciasInterface {
  public function metodo($metodo, $consulta);

  public function metDestroy($consulta);
}