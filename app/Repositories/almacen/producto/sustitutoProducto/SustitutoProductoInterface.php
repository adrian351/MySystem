<?php
namespace App\Repositories\almacen\producto\sustitutoProducto;

interface SustitutoProductoInterface {
    public function store($request, $id_producto);

    public function destroy($id_producto, $id_sustituto);
}