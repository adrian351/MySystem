<?php
namespace App\Repositories\tecnologiaDeLainformacion\inventarioEquipo;

interface InventarioEquipoInterface {
  public function inventarioFindOrFailById($id_inventario);
  
  public function getPagination($request);
  
  public function getAllInventarioEquiposPlunk();
  
  public function update($request, $id_inventario);
  
  public function destroy($id_inventario);
  
  public function store($request);
  
  public function getArchivosInventario($inventario);
  
  public function getHistorialesInventario($inventario, $request);
}