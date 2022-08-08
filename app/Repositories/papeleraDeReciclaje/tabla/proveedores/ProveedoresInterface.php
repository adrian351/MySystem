<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\proveedores;

interface ProveedoresInterface {
  public function metodo($metodo, $consulta);

  public function metDestroy($consulta);
}