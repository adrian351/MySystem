<?php
namespace App\Repositories\tecnologiaDeLainformacion\inventarioEquipo\archivoInventario;

interface  ArchivoInventarioInterface {
  public function archivoInventarioFindOrFailById($id_archivo);

  public function store($request, $id_inventario);

  public function destroy($id_archivo);
}