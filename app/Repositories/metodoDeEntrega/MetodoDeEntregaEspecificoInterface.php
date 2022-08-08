<?php
namespace App\Repositories\metodoDeEntrega;

interface MetodoDeEntregaEspecificoInterface {
  public function metodoEspecificoFirstByNombreMetodo($nom_met, $relaciones);
}