<?php
namespace App\Repositories\marca;

interface MarcaInterface {

  public function marcaAsignadoFindOrFailById($id_marca);

  public function getPagination($request);

  public function store($request);

  public function update($request, $id_marca);

  public function destroy($id_marca);

  public function Only_Marcas();

}