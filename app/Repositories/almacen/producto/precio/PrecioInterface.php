<?php
namespace App\Repositories\almacen\producto\precio;

interface PrecioInterface {
  public function precioFindOrFailById($id_precio, $relaciones);

  public function store($request, $id_producto);
  
  public function destroy($id_precio);
}