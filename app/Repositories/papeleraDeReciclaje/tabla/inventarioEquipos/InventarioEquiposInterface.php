<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\inventarioEquipos;

interface InventarioEquiposInterface {
  public function metodo($metodo, $consulta);

  public function metDestroy($consulta);
}