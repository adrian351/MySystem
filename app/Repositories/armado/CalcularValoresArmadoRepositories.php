<?php
namespace App\Repositories\armado;
// Repositories
use App\Repositories\servicio\calculo\CalculoRepositories;

class CalcularValoresArmadoRepositories implements CalcularValoresArmadoInterface {
  protected $calculoRepo;
  public function __construct(CalculoRepositories $calculoRepositories) {
    $this->calculoRepo      = $calculoRepositories;
  }
  public function calcularValoresArmado($armado, $productos) {
    $hastaC       = count($productos) - 1;
    $prec_orig_proveedor  = 0;
    $prec_origin  = 0;
    $tamano       = null;
    $peso         = 0;
    $alto         = 0;
    $ancho        = 0;
    $largo        = 0;
    for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
      if($productos[$contador2]->pivot != null) {
        $cant = $productos[$contador2]->pivot->cant;
      }else {
        $cant = $productos[$contador2]->cant;
      }

      // Calcular precio original con la suma de los productos precio proveedor
      $prec_orig_proveedor += $productos[$contador2]->prec_prove * $cant;

      // Calcular nuevo precio
      $prec_origin += $productos[$contador2]->prec_clien * $cant;
     
      // Calcular nuevo peso
      $peso += $productos[$contador2]->pes * $cant;
      
      // Calcular nuevas medidas
      if($productos[$contador2]->tam != null) {
        $tamano = $productos[$contador2]->tam;
      }
      $alto += $productos[$contador2]->alto * $cant;
      $ancho += $productos[$contador2]->ancho * $cant;
      $largo += $productos[$contador2]->largo * $cant;
    }

    if($armado->desc_esp > $prec_origin) {
      return abort('404', 'ERROR: No se puede modificar el precio del armado '. $armado->nom .' ya que el precio original es menor al descuento especial.');
    } else {
      $armado->prec_origin   = $prec_origin-$armado->desc_esp;
    }
    
    $armado->prec_de_comp  = $prec_orig_proveedor;
    $armado->tam           = $tamano;
    $armado->pes           = $peso;
    $armado->alto          = $alto;
    $armado->ancho         = $ancho;
    $armado->largo         = $largo;
    $armado->prec_redond = $this->calculoRepo->redondearUnidadA9DelPrecio($armado->prec_origin);
    $armado->save();
    return $armado;
  }
}