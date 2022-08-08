<?php
namespace App\Repositories\papeleraDeReciclaje;

interface PapeleraDeReciclajeInterface {
  public function getPagination($request);

  public function store($request);

  public function destroy($id_registro);

  public function restore($id_registro);

  public function destroyAllPapeleraByIdFk($id_registro, $id_resultado);

  public function tablas($registro, $metodo);
}