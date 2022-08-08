<?php
namespace App\Repositories\rol\permiso;

interface PermisoInterface {
  public function rolFindOrFailById($id_permiso);

  public function getPagination($request);

  

  public function getAllPermissionsPluck();
}