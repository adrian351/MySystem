<?php
namespace App\Repositories\armado\productoArmado;

interface ProductoArmadoInterface {
    public function store($request, $id_armado);

    public function destroy($id_armado, $id_producto);

    public function editCantidad($request, $id_producto, $id_armado);
}