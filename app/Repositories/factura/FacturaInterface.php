<?php
namespace App\Repositories\factura;

interface FacturaInterface {
  public function getFacturaFindOrFailById($id_factura, $relaciones, $estatus);
  
  public function getPagination($request);

  public function store($request);

  public function update($request, $id_factura);
  
  public function destroy($id_factura);

  public function updateSubirArchivos($request, $id_factura);
}