<?php
namespace App\Repositories\almacen\producto\proveedorProducto;

interface StoreProveedorProductoInterface {
  public function store($request, $id_producto);
}