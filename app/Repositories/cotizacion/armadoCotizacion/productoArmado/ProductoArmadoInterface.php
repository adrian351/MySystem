<?php
namespace App\Repositories\cotizacion\armadoCotizacion\productoArmado;

interface ProductoArmadoInterface {
    public function getproductoFindOrFailById($id_producto, $relaciones);

    public function store($request, $id_armado);

    public function destroy($id_producto);

    public function updateCantidad($request, $id_producto);

    public function updateUtilidad($request, $id_producto);
}