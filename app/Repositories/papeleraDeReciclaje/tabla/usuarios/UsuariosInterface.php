<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\usuarios;

interface UsuariosInterface {
  public function metodo($metodo, $consulta);

  public function metDestroy($consulta);
}