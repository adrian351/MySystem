<?php
namespace App\Repositories\cotizacion\armadoCotizacion\productoArmado;

interface StoreFilesInterface {
    public function storeProductos($productos, $id_armado);  
}