<?php
namespace App\Repositories\cotizacion;
// Repositories
use App\Repositories\servicio\calculo\CalculoRepositories;
use App\Repositories\armado\CalcularValoresArmadoRepositories;
use App\Repositories\cotizacion\armadoCotizacion\CalcularValoresArmadoCotizacionRepositories;

class CalcularValoresCotizacionRepositories implements CalcularValoresCotizacionInterface {
  protected $calcularValoresArmadoRepo;
  protected $calculoRepo;
  protected $calcularValoresArmadoCotizacionRepo;
  public function __construct(CalcularValoresArmadoRepositories $calcularValoresArmadoRepositories, CalculoRepositories $calculoRepositories, CalcularValoresArmadoCotizacionRepositories $calcularValoresArmadoCotizacionRepositories) {
    $this->calcularValoresArmadoRepo            = $calcularValoresArmadoRepositories;
    $this->calculoRepo                          = $calculoRepositories;
    $this->calcularValoresArmadoCotizacionRepo  = $calcularValoresArmadoCotizacionRepositories;
  }
  public function calculaValoresCotizacion($cotizacion) {
    $cotizacion->tot_arm    = $cotizacion->armados()->withTrashed()->sum('cant');
    $cotizacion->cost_env   = $cotizacion->armados()->withTrashed()->sum('cost_env');
    $cotizacion->desc       = $cotizacion->armados()->withTrashed()->sum('desc');
    $cotizacion->sub_total  = $cotizacion->armados()->withTrashed()->sum('sub_total');
    $cotizacion->iva        = $cotizacion->armados()->withTrashed()->sum('iva');

    if($cotizacion->con_com == 'on') {
      $total                = $cotizacion->armados()->withTrashed()->sum('tot');
      $comision             = $total * 1.05;
      $cotizacion->com      = $comision - $total;
      $cotizacion->tot      = $comision;
    } else {
      $cotizacion->com = 0.00;
      $cotizacion->tot = $cotizacion->armados()->withTrashed()->sum('tot');
    }

    $cotizacion->save();
    return $cotizacion;
  }
  public function calculaValoresCotizacionAlModificarProducto($producto) {
    $productos_armado_cotizacion = \App\Models\CotizacionArmadoProductos::where('id_producto', $producto->id)
      ->with(['armado'=> function ($query) { 
        $query->withTrashed();
      }])->withTrashed()->get();
    foreach($productos_armado_cotizacion as $producto_armado_cotizacion) {
      $producto_armado_cotizacion->tam         = $producto->tam;
      $producto_armado_cotizacion->alto        = $producto->alto;
      $producto_armado_cotizacion->ancho       = $producto->ancho;
      $producto_armado_cotizacion->largo       = $producto->largo;
      $producto_armado_cotizacion->cost_arm    = $producto->cost_arm;
      $producto_armado_cotizacion->pes         = $producto->pes;
      $producto_armado_cotizacion->prove       = $producto->prove;
      $producto_armado_cotizacion->prec_prove  = $producto->prec_prove;
      $producto_armado_cotizacion->prec_clien  = $this->calculoRepo->getUtilidadProducto($producto_armado_cotizacion->prec_prove, $producto_armado_cotizacion->utilid, $producto_armado_cotizacion->cost_arm);
      $producto_armado_cotizacion->save();

      $armado = $producto_armado_cotizacion->armado;
      // GENERA LOS NUEVOS VALORES PARA EL ARMADO
      $productos  = $armado->productos()->withTrashed()->get();
      $armado     = $this->calcularValoresArmadoRepo->calcularValoresArmado($armado, $productos); 
      $armado_cot = $this->calcularValoresArmadoCotizacionRepo->sumaValoresArmadoCotizacion($armado);
      $armado_cot->save();
    }
    if(count($productos_armado_cotizacion) > 0) {
      $armado = $productos_armado_cotizacion[0]->armado;
      $cotizacion = $armado->cotizacion()->withTrashed()->firstOrFail();
      // GENERA LOS NUEVOS VALORES PARA LA COTIZACIÓN
      $this->calculaValoresCotizacion($cotizacion);
    }
  }
}