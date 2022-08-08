<?php
namespace App\Repositories\servicio\calculo;

interface CalculoInterface {
    public function bcdivDosDecimales($valor);

    public function bcdivTresDecimales($valor);

    public function getUtilidadProducto($precio_proveedor, $utilidad, $costo_armado);

    public function calcularUtilidad($precio_proveedor, $utilidad);

    public function redondearUnidadA9DelPrecio($precio);
}