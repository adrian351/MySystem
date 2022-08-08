<?php
namespace App\Repositories\sistema\catalogo;

interface CatalogoInterface {
  public function catalogoAsignadoFindOrFailById($id_catalogo);

  public function getPagination($request);

  public function store($request);

  public function update($request, $id_catalogo);

  Public function destroy($id_catalogo);

  public function getAllInputCatalogosPlunk($input);

  public function getAllIdCatalogosPlunk($input);
}