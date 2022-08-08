<?php
namespace App\Repositories\material;

interface MaterialInterface {
  public function materialAsignadoFindOrFailById($id_material, $relaciones);

  public function getPagination($request);

  public function store($request);

  public function update($request, $id_material);

  public function destroy($id_material);

  public function getAllMaterialesPlunk();

  public function getMaterialFind($id_material);
}