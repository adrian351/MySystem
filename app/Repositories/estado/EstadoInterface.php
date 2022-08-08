<?php
namespace App\Repositories\estado;

interface EstadoInterface {
  public function getEstadosForaneosOLocalesPluck($foraneo_o_local);

  public function getAllEstadosPluck();
}