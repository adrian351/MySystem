<?php
namespace App\Repositories\almacen\producto\proveedorProducto;

interface ProveedorProductoInterface {

  public function update($request, $id_producto, $id_proveedor);
  
  public function destroy($id_producto, $id_proveedor);
}