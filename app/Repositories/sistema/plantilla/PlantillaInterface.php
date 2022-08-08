<?php
namespace App\Repositories\sistema\plantilla;

interface PlantillaInterface {
  public function plantillaAsignadoFindOrFailById($id_plantilla);

  public function plantillaFindOrFailById($id_plantilla);

  public static function accesoModelPlantillaFindOrFailById($id_plantilla);

  public function getPagination($request);

  public function store($request);

  public function update($request, $id_plantilla);

  public function destroy($id_plantilla);

  public function getAllPlantillasModuloPluck($modulo);
}