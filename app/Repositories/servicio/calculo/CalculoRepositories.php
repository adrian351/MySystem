<?php
namespace App\Repositories\servicio\calculo;

class CalculoRepositories implements CalculoInterface {
  public function bcdivDosDecimales($valor) {
    return bcdiv($valor, '1', 2);
  }
  public function bcdivTresDecimales($valor) {
    return bcdiv($valor, '1', 3);
  }
  public function getUtilidadProducto($precio_proveedor, $utilidad, $costo_armado) {
  //  $precio_proveedor_costo_armado = ceil($precio_proveedor) + ceil($costo_armado);
    $precio_proveedor_costo_armado = $precio_proveedor + $costo_armado;
    return $this->calcularUtilidad($precio_proveedor_costo_armado, $utilidad);
  }
  public function calcularUtilidad($precio_proveedor, $utilidad) {
    $utilidad =  $precio_proveedor / (1 - $utilidad);
    return bcdiv($utilidad, '1', 2);
  }
  public function redondearUnidadA9DelPrecio($precio) {
    $precio_convertido_a_texto = strval($precio);
    if($precio > 0) {
      $hastaC = strlen(intval($precio_convertido_a_texto)) - 1;
      $contador1 = 1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        if(strlen(intval($precio_convertido_a_texto)) == $contador1) {
          $arreglo2 = str_split(intval($precio_convertido_a_texto));
          if(intval($arreglo2[$contador2]) < 9) {
            $arreglo2[$contador2] = 9;
            $precio = implode($arreglo2);
          }
        }
        $contador1 += 1;
      }
    }
    return intval($precio);
  }
}