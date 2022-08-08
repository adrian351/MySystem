<?php
namespace App\Repositories\quejasYSugerencias;

interface QuejasYSugerenciasInterface {
  public function qYSFindOrFailById($id_qys, $relaciones);

  public function getPagination($request);

  public function store($request);
}