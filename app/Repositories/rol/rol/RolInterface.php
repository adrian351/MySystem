<?php
namespace App\Repositories\rol\rol;

interface RolInterface {
  public function rolAsignadoFindOrFailById($id_rol);

  public function getPagination($request);

  public function store($request);

  public function update($request, $id_rol);

  public function destroy($id_rol);

  public function getAllRolesPluckMenos($name);

  public function getSoloDosRolesPluck($name_rol1, $name_rol2);
}