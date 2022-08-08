<?php
namespace App\Repositories\rolFerro\envio\local;

interface EnvioLocalInterface {
  public function envioFindOrFailById($id_envio, $for_loc, $relaciones);

  public function getPagination($request, $for_loc, $relaciones);

  public function update($request, $id_envio, $for_loc, $modulo, $ruta);
}