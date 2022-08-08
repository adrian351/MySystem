<?php
namespace App\Http\Controllers\Almacen\PedidoActivo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\almacen\pedidoActivo\UpdatePedidoActivoRequest;
// Repositories
use App\Repositories\almacen\pedidoActivo\PedidoActivoRepositories;
use App\Repositories\almacen\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;
use App\Repositories\venta\pedidoActivo\codigoQR\GenerarQRRepositories;
use App\Repositories\almacen\producto\ProductoRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class PedidoActivoController extends Controller {
  protected $serviceCrypt;
  protected $pedidoActivoRepo;
  protected $armadoPedidoActivoRepo;
  protected $generarQRRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PedidoActivoRepositories $PedidoActivoRepositories, ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories, GenerarQRRepositories $generarQRRepositories, ProductoRepositories $productoRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->pedidoActivoRepo         = $PedidoActivoRepositories;
    $this->armadoPedidoActivoRepo   = $armadoPedidoActivoRepositories;
    $this->generarQRRepo            = $generarQRRepositories;
    $this->productoRepo             = $productoRepositories;
  }
  public function index(Request $request, $opc_consulta = null) {
    $pedidos        = $this->pedidoActivoRepo->getPagination($request, ['usuario', 'unificar'], $opc_consulta);
    $pen            = $this->pedidoActivoRepo->getPendientes();
    $pedidos_plunk  = $this->pedidoActivoRepo->getAllPedidosPlunk();
    return view('almacen.pedido.pedido_activo.alm_pedAct_index', compact('pedidos', 'pen', 'pedidos_plunk'));
  }
  public function show(Request $request, $id_pedido) {
    $pedido                     = $this->pedidoActivoRepo->pedidoActivoAlmacenFindOrFailById($id_pedido, ['usuario', 'archivos','unificar']);
    $unificados                 = $pedido->unificar()->paginate(99999999);
    $archivos                   = $pedido->archivos()->paginate(99999999);
    $armados                    = $this->pedidoActivoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_terminados_almacen = $this->armadoPedidoActivoRepo->armadosTerminadosAlmacen($pedido->id, [config('app.productos_completos'), config('app.en_produccion'), config('app.en_almacen_de_salida'), config('app.en_ruta'), config('app.entregado'), config('app.sin_entrega_por_falta_de_informacion'), config('app.intento_de_entrega_fallido')]);
    return view('almacen.pedido.pedido_activo.alm_pedAct_show', compact('pedido', 'unificados', 'archivos', 'armados', 'armados_terminados_almacen'));
  }
  public function edit(Request $request, $id_pedido) { 
    /*
    $pedido                     = $this->pedidoActivoRepo->pedidoActivoAlmacenFindOrFailById($id_pedido, ['unificar']);
    $unificados                 = $pedido->unificar()->paginate(99999999);
    $armados                    = $this->pedidoActivoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_terminados_almacen = $this->armadoPedidoActivoRepo->armadosTerminadosAlmacen($pedido->id, [config('app.productos_completos'), config('app.en_produccion'), config('app.en_almacen_de_salida'), config('app.en_ruta'), config('app.entregado'), config('app.sin_entrega_por_falta_de_informacion'), config('app.intento_de_entrega_fallido')]);
    return view('almacen.pedido.pedido_activo.alm_pedAct_edit', compact('pedido', 'unificados', 'armados', 'armados_terminados_almacen'));
    */

    $pedido = $this->pedidoActivoRepo->pedidoActivoAlmacenFindOrFailById($id_pedido, ['unificar', 'armados' => function($query1) {
      $query1->where(function ($query){
        $query->where('estat', config('app.en_espera_de_compra'))
          ->orWhere('estat', config('app.en_revision_de_productos'));
      })
      ->with(['productos' => function($query2) {
        $query2->with('sustitutos');
      }])->select(['id', 'nom', 'cant', 'pedido_id', 'es_de_stock']);
    }]);

    $unificados                 = $pedido->unificar()->paginate(99999999);

    $nuevo_array = [];
    $contador2 = 0;
    $contador3 = 0;
    $contador4 = 0;
    $contador7 = 0;
    foreach($pedido->armados as $armado) {
      foreach($armado->productos as $producto) {
        // Verifica si el nuevo array es null
        if(empty($nuevo_array)) {
          $nuevo_array[$contador2]['ids'][$contador7]           = $producto->id;
          $nuevo_array[$contador2]['id_producto_origin']        = $producto->id_producto;
          $nuevo_array[$contador2]['cantidad']                  = $producto->cant*$armado->cant;
          $nuevo_array[$contador2]['nombre_producto']           = $producto->produc;

          $func = $this->agregarSutituto($producto, $nuevo_array, $contador2, $contador4);
          $nuevo_array  = $func[0];
          $contador4    = $func[1];

          $contador2 ++;
          $contador7 ++;
        } else {
          $existe_producto = 'No';
          for($contador6 = 0;$contador6<count($nuevo_array) ;$contador6++) {
            if($nuevo_array[$contador6]['id_producto_origin'] == $producto->id_producto) {
              $existe_producto = 'Si';
              $num_producto_repetido = $contador6;
            }
          }
          if($existe_producto == 'No') {
            $nuevo_array[$contador2]['ids'][$contador7]           = $producto->id;
            $nuevo_array[$contador2]['id_producto_origin']        = $producto->id_producto;
            $nuevo_array[$contador2]['cantidad']                  = $producto->cant*$armado->cant;
            $nuevo_array[$contador2]['nombre_producto']           = $producto->produc;
                                                     
            $func = $this->agregarSutituto($producto, $nuevo_array, $contador2, $contador4);
            $nuevo_array  = $func[0];
            $contador4    = $func[1];

            $contador2 ++;
            $contador7 ++;
          } else {
            // Si el producto ya existe en el array solo suma las cantidades del prosducto y sustituto
            $nuevo_array[$num_producto_repetido]['ids'][$contador7]      = $producto->id;
            $nuevo_array[$num_producto_repetido]['cantidad'] += $producto->cant*$armado->cant;
            $contador7 ++;

            for($contador8 = 0;$contador8<count($producto->sustitutos) ;$contador8++) {
              $sustituto = $producto->sustitutos[$contador8];
              $contador = 0;
              $existe_sustituto = 'No';
              for($contador9 = 0;$contador9<count($nuevo_array[$num_producto_repetido]['sustitutos']) ;$contador9++) {
                if($nuevo_array[$num_producto_repetido]['sustitutos'][$contador9]['id_producto'] == $sustituto->id_producto) {
                  $existe_sustituto = 'Si';
                  $num_sustituto_repetido = $contador9;
                }
              }
              if($existe_sustituto == 'No') {
                if($contador == 0) {
                  $contador = count($nuevo_array[$num_producto_repetido]['sustitutos']);
                }
              
                $nuevo_array[$num_producto_repetido]['sustitutos'][$contador]['ids'][$contador4]  = $sustituto->id;
                $nuevo_array[$num_producto_repetido]['sustitutos'][$contador]['id_producto']      = $sustituto->id_producto;
                $nuevo_array[$num_producto_repetido]['sustitutos'][$contador]['cantidad']         = $sustituto->cant;
                $nuevo_array[$num_producto_repetido]['sustitutos'][$contador]['producto']         = $sustituto->produc;
                $nuevo_array[$num_producto_repetido]['sustitutos'][$contador]['producto_id']      = $sustituto->producto_id;
              }else {
                $nuevo_array[$num_producto_repetido]['sustitutos'][$contador]['ids'][$contador4]        = $sustituto->id;
                $nuevo_array[$num_producto_repetido]['sustitutos'][$num_sustituto_repetido]['cantidad']  += $sustituto->cant;
              }
              $contador4++;
            }
          }
        }
      }
    }

    for($contador6 = 0;$contador6<count($nuevo_array);$contador6++) {
      $produc_original  = $this->productoRepo->getproductoFindById($this->serviceCrypt->encrypt($nuevo_array[$contador6]['id_producto_origin']), ['sustitutos']);
      $nuevo_array[$contador6]      = $this->sutitutoMenos($produc_original, $nuevo_array[$contador6]);
    }

    $productos = $nuevo_array;
    return view('almacen.pedido.pedido_activo.alm_pedAct_edit', compact('pedido', 'unificados', 'productos'));
  }

  public function sutitutoMenos($produc_original, $nuevo_array) {
    if($produc_original != NULL) {
      $prod_menos = $nuevo_array['sustitutos'];
      $hastaC = count($prod_menos) -1;
      if($hastaC >= 0) {
        $nuevo_array['list_sustitutos'] = $produc_original->sustitutos()->where(function($query) use($prod_menos, $hastaC) {
          for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
            $query->where('productos.id', '!=', $prod_menos[$contador2]['id_producto']);
          }
        })->orderBy('produc', 'ASC')->pluck('produc', 'productos.id');
      } else {
        $nuevo_array['list_sustitutos'] = $produc_original->sustitutos()->orderBy('produc', 'DESC')->pluck('produc', 'productos.id');
      }
    } else {
      $nuevo_array['list_sustitutos'] = [];
    }

    return $nuevo_array;
  }
  public function agregarSutituto($producto, $nuevo_array, $contador2, $contador4) {
    $pro = count($producto->sustitutos);
    if($pro > 0) {
      $contador5 = 0;
      foreach($producto->sustitutos as $sustituto) {
        $nuevo_array[$contador2]['sustitutos'][$contador5]['ids'][$contador4] = $sustituto->id;
        $nuevo_array[$contador2]['sustitutos'][$contador5]['id_producto']     = $sustituto->id_producto;
        $nuevo_array[$contador2]['sustitutos'][$contador5]['cantidad']        = $sustituto->cant;
        $nuevo_array[$contador2]['sustitutos'][$contador5]['producto']        = $sustituto->produc;
        $nuevo_array[$contador2]['sustitutos'][$contador5]['producto_id']     = $sustituto->producto_id;
        $contador5 ++;
        $contador4 ++;
      }
    }else {
      $nuevo_array[$contador2]['sustitutos'] = [];
    }
    return [$nuevo_array,  $contador4];
  }
  public function update(UpdatePedidoActivoRequest $request, $id_pedido) {
    $pedido = $this->pedidoActivoRepo->update($request, $id_pedido);
    if($pedido->estat_alm == config('app.productos_completos_terminado')) {
      toastr()->success('¡Pedido terminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return redirect(route('almacen.pedidoActivo.index')); 
    }
    toastr()->success('¡Pedido modificados exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return redirect(route('almacen.pedidoActivo.edit', $this->serviceCrypt->encrypt($pedido->id)));
  }
  public function generarOrdenDeProduccion($id_pedido){
    $pedido               = $this->pedidoActivoRepo->pedidoActivoAlmacenFindOrFailById($id_pedido, ['usuario', 'unificar', 'archivos']);
    $archivos = $pedido->archivos->count();
    
    $codigoQRAlmacen = $this->generarQRRepo->qr($pedido->id, 'Almacén');
    $codigoQRProduccion = $this->generarQRRepo->qr($pedido->id, 'Producción');
    $codigoQRLogistica = $this->generarQRRepo->qr($pedido->id, 'Logística');

    $armados              = $pedido->armados()->with(['direcciones', 'productos'=> function ($query) {
                                                            $query->with('sustitutos');
                                                          }])->get();
    $orden_de_produccion  = \PDF::loadView('almacen.pedido.pedido_activo.export.ordenDeProduccion', compact('pedido', 'armados', 'archivos', 'codigoQRAlmacen', 'codigoQRProduccion', 'codigoQRLogistica'));
    return $orden_de_produccion->stream();
//  return $orden_de_produccion->download('OrdenDeProduccionAlmacen-'$pedido->num_pedido.'.pdf'); // Descargar
  }
  public function marcarTodoCompleto($id_pedido) {
    $pedido = $this->pedidoActivoRepo->marcarTodoCompleto($id_pedido);
    if($pedido->estat_alm == config('app.productos_completos_terminado')) {
      toastr()->success('¡Pedido terminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return redirect(route('almacen.pedidoActivo.index')); 
    }
    toastr()->success('¡Armados modificados exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return redirect(route('almacen.pedidoActivo.edit', $this->serviceCrypt->encrypt($pedido->id))); 
  }
  // genrar reporte de pedidos
  public function generarReporte(Request $request) {
    return (new \App\Exports\almacen\pedido\generarReporteExport($request->id_pedidos))->download('Reporte-'.date('Y-m-d').'.xlsx');
  }
}