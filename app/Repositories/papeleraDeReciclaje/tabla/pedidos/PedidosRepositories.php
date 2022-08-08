<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\pedidos;

class PedidosRepositories implements PedidosInterface {

  public function metodo($metodo, $consulta) {
    if($metodo == 'destroy') {
      $this->metDestroy($consulta);
    }
  }
  public function metDestroy($consulta) {
    $armados = $consulta->armados()->with(['direcciones'=> function ($query) {
                $query->select('id', 'tarj_dise_rut', 'tarj_dise_nom', 'comp_de_sal_rut', 'comp_de_sal_nom', 'pedido_armado_id')->with(['comprobantes'=> function ($query) {
                  $query->select('id', 'comp_ent_rut', 'comp_ent_nom', 'direccion_id')->withTrashed();
                }])->withTrashed();
              }, 'productos'=> function ($query) {
                $query->with(['sustitutos'=> function ($query) {
                  $query->withTrashed();
                }])->withTrashed();
              }])->withTrashed()->get(['id', 'img_rut', 'img_nom', 'cant']);
      
    $cont1 = 0;
    $archivos_a_eliminar = null;
    foreach($armados as $armado) {
      /*
      * RESTABLECE EL STOCK DE LOS PRODUCTOS RELACIONADOS A ESTE PEDIDO SI EL ESTATUS DEL PEDIDO ES DIFERENTE A ENTREGADO
      */
      if($consulta->estat_log != config('app.entregado')) {
        foreach($armado->productos as $producto) {
          $total_sustitutos = 0;
          // AUMENTA STOCK AL SUSTITUTO ORIGINAL
          foreach($producto->sustitutos as $sustituto) {
            $sustituto_original1         = \App\Models\Producto::findOrFail($sustituto->id_producto);
            if($sustituto_original1 != NULL) {
              $sustituto_original1->stock += $sustituto->cant;
              $total_sustitutos           += $sustituto->cant;
              $sustituto_original1->save();
            }
          }

          // AUMENTA STOCK AL PRODUCTO ORIGINAL
          $producto_original1         = \App\Models\Producto::findOrFail($producto->id_producto);
          if($producto_original1 != NULL) {
            $cant = $producto->cant * $armado->cant;
            $producto_original1->stock += $cant-$total_sustitutos;
            $producto_original1->save();
          }
        }
      }

      // FUNCION QUE ELIMINA TODOS LOS ARCHIVOS DE LOS ARMADOS, DIRECCIONES, COMPROBANTES DE ENTREGA QUE ESTEN RELACIONADOS AL PEDIDO
      foreach($armado->direcciones as $direccion) {
        // AÑADE LA RUTA Y NOMBRE DE LAS TARJETAS DE FELICITACION
        if($direccion->tarj_dise_nom != null) {
          $archivos_a_eliminar[$cont1] = $direccion->tarj_dise_nom;
          $cont1 +=1;
        }

        // AÑADE LA RUTA Y NOMBRE DE LOS COMPROBANTES DE SALIDA
        if($direccion->comp_de_sal_nom != null) {
          $archivos_a_eliminar[$cont1] = $direccion->comp_de_sal_nom;
          $cont1 +=1;
        }
        // AÑADE LA RUTA Y NOMBRE DE LOS COMPROBANTES DE ENTREGA Y COMPROBANTE COSTO POR ENVIO
        foreach($direccion->comprobantes as $comprobanteDeEntrega) {
          if($comprobanteDeEntrega->comp_ent_nom != null) {
            $archivos_a_eliminar[$cont1] = $comprobanteDeEntrega->comp_ent_nom;
            $cont1 +=1;
          }
          /*
          if($comprobanteDeEntrega->comp_cost_por_env_log_nom != null) {
            $archivos_a_eliminar[$cont1] = $comprobanteDeEntrega->comp_cost_por_env_log_nom;
            $cont1 +=1;
          }
          */
        }
      }
    }

    // FUNCION QUE ELIMINA TODOS LOS ARCHIVOS DE LOS PAGOS, COMPROBANTES DE PAGO QUE ESTEN RELACIONADOS AL PEDIDO
    $pagos = $consulta->pagos()->with(['factura'=> function ($query) {
        $query->select('id', 'fact_pdf_rut', 'fact_pdf_nom', 'fact_xlm_rut', 'fact_xlm_nom', 'ppd_pdf_rut', 'ppd_pdf_nom', 'ppd_xlm_rut', 'ppd_xlm_nom', 'pago_id')->withTrashed();
      }])->withTrashed()->get(['id', 'comp_de_pag_rut', 'comp_de_pag_nom', 'cop_de_indent_rut', 'cop_de_indent_nom']);

    foreach($pagos as $pago) {
      if($pago->comp_de_pag_nom != null) {
        $archivos_a_eliminar[$cont1] = $pago->comp_de_pag_nom;
        $cont1 +=1;
      }
      if($pago->cop_de_indent_nom != null) {
        $archivos_a_eliminar[$cont1] = $pago->cop_de_indent_nom;
        $cont1 +=1;
      }

      /*
      * ELIMINA LOS ARCHIVOS DE LA FACTURA RELACIONADA AL PAGO
      */
      $factura = $pago->factura;
      if(empty($factura) == false) {
        if($factura->fact_pdf_nom != null) {
          $archivos_a_eliminar[$cont1] = $factura->fact_pdf_nom;
          $cont1 +=1;
        }
        if($factura->fact_xlm_nom != null) {
          $archivos_a_eliminar[$cont1] = $factura->fact_xlm_nom;
          $cont1 +=1;
        }
        if($factura->ppd_pdf_nom != null) {
          $archivos_a_eliminar[$cont1] = $factura->ppd_pdf_nom;
          $cont1 +=1;
        }
        if($factura->ppd_xlm_nom != null) {
          $archivos_a_eliminar[$cont1] = $factura->ppd_xlm_nom;
          $cont1 +=1;
        }
      }
    }
    // Se implementa esta forma de eliminar archivos ya que con la funcion "ArchivosEliminados::dispatch" no lo hace
    \Storage::disk('s3')->delete($archivos_a_eliminar);
  }
}