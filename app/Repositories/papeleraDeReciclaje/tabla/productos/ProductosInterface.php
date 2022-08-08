<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\productos;

interface ProductosInterface {
  public function metodo($metodo, $consulta);

  public function metDestroy($consulta);
}