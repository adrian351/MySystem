<?php
namespace App\Repositories\cotizacion\armadoCotizacion;
// Repositories
use App\Repositories\servicio\calculo\CalculoRepositories;

class CalcularValoresArmadoCotizacionRepositories implements CalcularValoresArmadoCotizacionInterface {
  protected $calculoRepo;
  public function __construct(CalculoRepositories $calculoRepositories) {
    $this->calculoRepo      = $calculoRepositories;
  }
  public function sumaValoresArmadoCotizacion($armado) {
    $armado = $this->calcularDescuento($armado);
  //  dd(   $armado->prec_origin     );
  //   $armado->prec_redond = $this->calculoRepo->redondearUnidadA9DelPrecio($armado->prec_origin-$armado->desc_esp);
  //   dd(   $armado->prec_redond     );
    $sub_total          = ($armado->cant * $armado->prec_redond) + $armado->cost_env;
  //  dd(   $sub_total     );
    $armado->sub_total  = $sub_total - $armado->desc;
    if($armado->con_iva == 'Con IVA') {
      $armado->iva  = $armado->sub_total * 0.16;
    } elseif($armado->con_iva == 'Sin IVA') {
      $armado->iva  = 0.00;
    }
    $armado->tot    = $armado->sub_total + $armado->iva;
    return $armado;
  }
  public function calcularDescuento($armado) {
    if($armado->es_de_regalo == 'Si') {
      $armado->tip_desc = 'Manual';
      $armado->porc     = null;
      $manual           = $armado->cant * $armado->prec_redond;
      $armado->manu     = $manual;
      $armado->desc     = $manual;
    } elseif($armado->es_de_regalo == 'No') {
      if($armado->getOriginal('es_de_regalo') == $armado->getAttribute('es_de_regalo')) {
        if($armado->tip_desc == 'Manual') {
          $armado->porc = null;
          $armado->desc = $armado->manu;
        } elseif($armado->tip_desc == 'Porcentaje') {
          $armado->manu = null;
          $armado->desc = ($armado->cant * $armado->prec_redond) * $armado->porc;
        }elseif($armado->tip_desc == 'Sin descuento') {
          $armado->porc = null;
          $armado->manu = null;
          $armado->desc = 0.00;
        }
      } elseif($armado->getOriginal('es_de_regalo') != $armado->getAttribute('es_de_regalo')) {
        $armado->tip_desc = 'Sin descuento';
        $armado->porc     = null;
        $armado->manu     = 0.00;
        $armado->desc     = 0.00;
      }
    }
    return  $armado;
  }
}