<?php
namespace App\Repositories\categoria;

interface CategoriaInterface {

  public function categoriaAsignadoFindOrFailById($id_categoria);

  public function getPagination($request);

  public function store($request);

  public function update($request, $id_categoria);

  public function destroy($id_categoria);

  public function all_Categorias();

  public function Only_Categorias();
}