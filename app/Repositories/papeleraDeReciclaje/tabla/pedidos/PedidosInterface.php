<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\pedidos;

interface PedidosInterface {
  public function metodo($metodo, $consulta);

  public function metDestroy($consulta);
}