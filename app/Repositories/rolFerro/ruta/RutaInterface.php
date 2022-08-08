<?php
namespace App\Repositories\rolFerro\ruta;

interface RutaInterface {
  public function rutaFindOrFailById($id_ruta, $relaciones);

  public function getPagination($request);

  public function store($request);

  public function update($request, $id_ruta);

  Public function destroy($id_ruta);

  public function allRutasPlunk();
}