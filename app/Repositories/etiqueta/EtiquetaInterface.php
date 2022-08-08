<?php
namespace App\Repositories\etiqueta;

interface EtiquetaInterface {

  public function etiquetaAsignadoFindOrFailById($id_etiqueta);

  public function getPagination($request);

  public function store($request);

  public function update($request, $id_etiqueta);

  public function destroy($id_etiqueta);

  public function all_Etiquetas();

  public function Only_Etiquetas();
}