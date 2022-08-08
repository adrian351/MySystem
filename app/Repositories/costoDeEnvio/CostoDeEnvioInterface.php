<?php
namespace App\Repositories\costoDeEnvio;

interface CostoDeEnvioInterface {
  public function costoDeEnvioAsignadoFindOrFailById($id_costo);

  public function getPagination($request);

  public function store($request);

  public function update($request, $id_costo);

  public function destroy($id_costo);

  public function obtener($request);
}