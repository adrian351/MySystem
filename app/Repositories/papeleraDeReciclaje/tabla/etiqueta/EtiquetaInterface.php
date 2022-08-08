<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\etiqueta;

interface EtiquetaInterface {
  public function metodo($metodo, $consulta);

  public function metDestroy($consulta);
}