<?php
namespace App\Repositories\cotizacion\armadoCotizacion\productoArmado;
// Models
use App\Models\CotizacionArmadoProductos;

class StoreFilesRepositories implements StoreFilesInterface {
  public function storeProductos($productos, $id_armado) {
    // Agrega los producto del armado al armado de la cotización
    $camposBD = array('id_producto', 'cant', 'produc', 'sku', 'marc', 'tip', 'tam', 'alto', 'ancho', 'largo', 'cost_arm', 'prove', 'prec_prove', 'utilid', 'prec_clien', 'categ', 'etiq', 'pes', 'cod_barras', 'armado_id', 'created_at', 'updated_at');
    $hastaC = count($productos) - 1;
    $datos = null;
    if($hastaC > -1) {
      $contador3 = 0;
      $fecha = date('Y-m-d h:i:s');
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        // Aborta el proceso si el producto relacionado al armado no tiene un proveedor asignado ya que se utiliza el precio del proveedor para hcaer los calculos
        if($productos[$contador2]->prec_prove == NULL OR $productos[$contador2]->prove == NULL) { 
          return abort(403, 'El producto: ' . $productos[$contador2]->produc . ' no tiene un proveedor asignado.');
        }
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->id;
        $contador3 += 1;
        if($productos[$contador2]->pivot == null) {
          $cantid = 1;
        } else {
          $cantid = $productos[$contador2]->pivot->cant;
        }
        $datos[$contador2][$camposBD[$contador3]] = $cantid;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->produc;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->sku;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->marc;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->tip;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->tam;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->alto;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->ancho;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->largo;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->cost_arm;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->prove;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->prec_prove;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->utilid;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->prec_clien;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->categ;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->etiq;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->pes;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $productos[$contador2]->cod_barras;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $id_armado;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $fecha;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $fecha;
        $contador3 = 0;
      }
      CotizacionArmadoProductos::insert($datos);
    }
    return $datos;
  }
}