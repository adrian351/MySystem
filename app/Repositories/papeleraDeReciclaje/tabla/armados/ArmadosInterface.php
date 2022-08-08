<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\armados;

interface ArmadosInterface {
  public function metodo($metodo, $consulta);

  public function metDestroy($consulta);
}