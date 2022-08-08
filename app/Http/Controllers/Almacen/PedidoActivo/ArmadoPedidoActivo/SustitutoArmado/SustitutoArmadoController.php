<?php
namespace App\Http\Controllers\Almacen\PedidoActivo\ArmadoPedidoActivo\SustitutoArmado;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\almacen\pedidoActivo\armadoPedidoActivo\sustitutoArmado\UpdateSustitutoArmadoRequest;
// Models
use App\Models\PedidoArmadoTieneProducto;
use App\Models\PedidoArmadoProductoTieneSustituto;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\almacen\producto\ProductoRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class SustitutoArmadoController extends Controller {
  protected $serviceCrypt;
  protected $productoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ProductoRepositories $productoRepositories) {
    $this->serviceCrypt   = $serviceCrypt;
    $this->productoRepo   = $productoRepositories;
  }
  public function create($id_producto) {
    $id_producto      = $this->serviceCrypt->decrypt($id_producto);
    $producto         = PedidoArmadoTieneProducto::with('sustitutos')->findOrFail($id_producto);
    $this->verificarEstatusArmado($producto);
    $sustitutos       = $producto->sustitutos()->paginate(99999999);
    $produc_original  = $this->productoRepo->getproductoFindById($this->serviceCrypt->encrypt($producto->id_producto), ['sustitutos']);
    
    if($produc_original != NULL) {
      $sustitutos_list = $produc_original->sustitutos()->orderBy('produc', 'DESC')->pluck('produc', 'productos.id');
      $prod_menos = $producto->sustitutos;
      $sustitutos_list = $produc_original->sustitutos()->where(function($query) use($prod_menos) {
        $hastaC = count($prod_menos) -1;
        for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
          $query->where('productos.id', '!=', $prod_menos[$contador2]->id_producto);
        }
      })->orderBy('produc', 'ASC')->pluck('produc', 'productos.id');
    } else {
      $sustitutos_list = [];
    }

    return view('almacen.pedido.pedido_activo.armado_activo.productos_armado.sustitutos_producto.susPro_create', compact('producto', 'sustitutos', 'sustitutos_list'));
  }
  public function store(Request $request, $ids) {
    // ================= VALIDACION
    $ids            = $this->serviceCrypt->decrypt($ids);
  
    $contador100 = 0;
    foreach($ids[0] as $id) {
      $idss[$contador100] = $id;
      $contador100 ++; 
    }

    $productos = \App\Models\PedidoArmadoTieneProducto::where(function($query) use($idss) {
      $hastaC = count($idss) -1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        $query->orwhere('id', $idss[$contador2]);
      }
    })
    ->with(['sustitutos' => function($query1) {
      $query1->sum('cant');
    }, 'armado:id,cod,cant,pedido_id,estat'])
    ->get();
 
    // Suma total de los sustitutos de los productos
    $array = [];
    $total_sustitutos = 0;
    $contador2 = 0;
    foreach($productos as $producto) {
      $array[$contador2]['id_producto'] = $producto->id;
      $array[$contador2]['id_producto_original'] = $producto->id_producto;
      $array[$contador2]['cant_total'] = $producto->cant*$producto->armado->cant;

      if(count($producto->sustitutos)>0) {
        foreach($producto->sustitutos as $sustitutos) {
          $total_sustitutos += $sustitutos->cant;
        }
      }
      $contador2++;
    }

    $max_sustitutos = $ids[1] - $total_sustitutos;
 
    $this->validate($request, [
      'cantidad'  => 'required|integer|min:1|max:'.$max_sustitutos,
      'sustituto' => 'required|exists:productos,id',
    ]);

  // ================= FIN VALIDACION
    try { DB::beginTransaction();

      // CHECA EL ESTATUS DEL ARCÓN RELACIONADO AL PRODUCTO PARA VERIFICAR SI AUN ESTA EL ALMACEN 
      foreach($productos as $producto) {
        if($producto->armado->estat != config('app.en_espera_de_compra') AND $producto->armado->estat != config('app.en_revision_de_productos')  ) {
          return abort(404, 'Algo ocurrió: Regresa a la ventana anterior y recárgala.');
        }
      }

      if($producto->armado->pedido->bod == 'Temas'){
        $producto_original1         = $this->productoRepo->getproductoFindWithTrashed($this->serviceCrypt->encrypt($producto->id_producto), []);
        $producto_original1->stock_temas += $request->cantidad;
        $producto_original1->save();

        // RESTA AL STOCK LA CANTIDAD ESCRITA EN EL FORMULARIO AL NUEVO PRODUCTO QUE SE ESTA TOMANDO COMO SUSTITUTO DEL PRODUCTO QUE ESTA ASIGNADO DIRECTAMENTE AL ARMADO
        $producto_original2         = $this->productoRepo->getproductoFindWithTrashed($this->serviceCrypt->encrypt($request->sustituto), []);
        $producto_original2->stock_temas -= $request->cantidad;
        $producto_original2->save();
      }else{
      // SUMA AL STOCK LA CANTIDAD ESCRITA EN EL FORMULARIO AL PRODUCTO QUE ESTA ASIGNADO DIRECTAMENTE AL ARMADO
      $producto_original1         = $this->productoRepo->getproductoFindWithTrashed($this->serviceCrypt->encrypt($producto->id_producto), []);
      $producto_original1->stock += $request->cantidad;
      $producto_original1->save();

      // RESTA AL STOCK LA CANTIDAD ESCRITA EN EL FORMULARIO AL NUEVO PRODUCTO QUE SE ESTA TOMANDO COMO SUSTITUTO DEL PRODUCTO QUE ESTA ASIGNADO DIRECTAMENTE AL ARMADO
      $producto_original2         = $this->productoRepo->getproductoFindWithTrashed($this->serviceCrypt->encrypt($request->sustituto), []);
      $producto_original2->stock -= $request->cantidad;
      $producto_original2->save();
      }
      // HACE LA PARTICIÓN DEL PRODUCTO A LOS DIFERENTES ARMADOS
      $can_tot_a_sustituir = $request->cantidad;
      $tot_sus_pro = 0;
      foreach($productos as $producto) {
        $tot_sus_pro = 0;
        //CANTIDAD TOTAL DE SUSTITUTOS DEL PRODUCTO
        if(count($producto->sustitutos)>0) {
          foreach($producto->sustitutos as $sustituto) {
            $tot_sus_pro += $sustituto->cant;
          }
        }
        $cant_max_per = $producto->cant*$producto->armado->cant;
        // Si la cantidad maxima de productos permitida es mayor a la catidad total de sustitutos
        if($cant_max_per>$tot_sus_pro) {
          $sca = $producto->cant*$producto->armado->cant;
          $sca = $sca -$tot_sus_pro;

          $can_tot_a_sustituir1 = $can_tot_a_sustituir;
          $can_tot_a_sustituir -= $sca;
          if($can_tot_a_sustituir > 0) {
            $sustituto = new PedidoArmadoProductoTieneSustituto();
            $sustituto->id_producto     = $producto_original2->id;
            $sustituto->cant            = $sca;
            $sustituto->produc          = $producto_original2->produc;
            $sustituto->producto_id     = $producto->id;
            $sustituto->created_at_sus  = Auth::user()->email_registro;
            $sustituto->save();
          } else {
            $sca = $can_tot_a_sustituir1;

            $sustituto = new PedidoArmadoProductoTieneSustituto();
            $sustituto->id_producto     = $producto_original2->id;
            $sustituto->cant            = $sca;
            $sustituto->produc          = $producto_original2->produc;
            $sustituto->producto_id     = $producto->id;
            $sustituto->created_at_sus  = Auth::user()->email_registro;
            $sustituto->save();
            break;
          }
        }
      }
      DB::commit();
      toastr()->success('¡Sustituto agregado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return back();
    } catch(\Exception $e) { DB::rollback(); throw $e; }
    
/*
    try { DB::beginTransaction();
      $id_producto            = $this->serviceCrypt->decrypt($ids);
      $producto_armado_pedido = PedidoArmadoTieneProducto::findOrFail($id_producto);

      $this->verificarEstatusArmado($producto_armado_pedido);

      // SUMA AL STOCK LA CANTIDAD ESCRITA EN EL FORMULARIO AL PRODUCTO QUE ESTA ASIGNADO DIRECTAMENTE AL ARMADO
      $producto_original1         = $this->productoRepo->getproductoFindWithTrashed($this->serviceCrypt->encrypt($producto_armado_pedido->id_producto), []);
      $producto_original1->stock += $request->cantidad;
      $producto_original1->save();

      // RESTA AL STOCK LA CANTIDAD ESCRITA EN EL FORMULARIO AL NUEVO PRODUCTO QUE SE ESTA TOMANDO COMO SUSTITUTO DEL PRODUCTO QUE ESTA ASIGNADO DIRECTAMENTE AL ARMADO
      $producto_original2         = $this->productoRepo->getproductoFindWithTrashed($this->serviceCrypt->encrypt($request->sustituto), []);
      $producto_original2->stock -= $request->cantidad;
      $producto_original2->save();
      
      // AGREGA Y ASIGNA EL SUSTITUTO AL PRODUCTO DEL ARMADO
      $sustituto = new PedidoArmadoProductoTieneSustituto();
      $sustituto->id_producto     = $producto_original2->id;
      $sustituto->cant            = $request->cantidad;
      $sustituto->produc          = $producto_original2->produc;
      $sustituto->producto_id     = $id_producto;
      $sustituto->created_at_sus  = Auth::user()->email_registro;
      $sustituto->save();

      DB::commit();
      toastr()->success('¡Sustituto agregado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return back();
    } catch(\Exception $e) { DB::rollback(); throw $e; }
*/
  }
  public function destroy($id_sustituto) {
    try { DB::beginTransaction();
      $id_sustituto = $this->serviceCrypt->decrypt($id_sustituto);
  
      $sustitutos = PedidoArmadoProductoTieneSustituto::where(function($query) use($id_sustituto) {
        foreach($id_sustituto as $id_sustitutoo) {
          $query->orwhere('id', $id_sustitutoo);
        }
      })
      ->with(['producto' => function($query) {
        $query->with('armado:id,cod,cant,pedido_id,estat');
      }])
      ->get();

      
       // CHECA EL ESTATUS DEL ARCÓN RELACIONADO AL PRODUCTO PARA VERIFICAR SI AUN ESTA EL ALMACEN 
       foreach($sustitutos as $sustituto) {
        if($sustituto->producto->armado->estat != config('app.en_espera_de_compra') AND $sustituto->producto->armado->estat != config('app.en_revision_de_productos')  ) {
          return abort(404, 'Algo ocurrió: Regresa a la ventana anterior y recárgala.');
        }
      }


      // Suma total de los sustitutos de los productos
      $total_sustitutos = 0;
      foreach($sustitutos as $sustituto) {
        $total_sustitutos += $sustituto->cant;
      }
       
      // SUMA AL STOCK LA CANTIDAD ESCRITA EN EL FORMULARIO AL PRODUCTO QUE ESTA ASIGNADO DIRECTAMENTE AL ARMADO
      $producto_original1         = $this->productoRepo->getproductoFindWithTrashed($this->serviceCrypt->encrypt($sustitutos[0]->id_producto), []);
      $producto_original1->stock += $total_sustitutos;
      $producto_original1->save();

      // RESTA AL STOCK LA CANTIDAD ESCRITA EN EL FORMULARIO AL NUEVO PRODUCTO QUE SE ESTA TOMANDO COMO SUSTITUTO DEL PRODUCTO QUE ESTA ASIGNADO DIRECTAMENTE AL ARMADO
      $producto_original2         = $this->productoRepo->getproductoFindWithTrashed($this->serviceCrypt->encrypt($sustitutos[0]->producto->id_producto), []);
      $producto_original2->stock -= $total_sustitutos;
      $producto_original2->save();

      // Elimina la relación con los sustitutos
      foreach($sustitutos as $sustituto) {
        $sustituto->forceDelete();
      }

      DB::commit();
      toastr()->success('¡Sustituto eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return back();
    } catch(\Exception $e) { DB::rollback(); throw $e; }
    /*
    try { DB::beginTransaction();
      $id_sustituto = $this->serviceCrypt->decrypt($id_sustituto);
      $sustituto    = PedidoArmadoProductoTieneSustituto::with('producto')->findOrFail($id_sustituto);
      $this->verificarEstatusArmado($sustituto->producto);
      $sustituto->forceDelete();

      // RESTA AL STOCK LA CANTIDAD ESCRITA EN EL FORMULARIO AL PRODUCTO QUE ESTA ASIGNADO DIRECTAMENTE AL ARMADO
      $producto_original1         = $this->productoRepo->getproductoFindWithTrashed($this->serviceCrypt->encrypt($sustituto->producto->id_producto), []);
      if($producto_original1 != NULL) {
        $producto_original1->stock -= $sustituto->cant;
        $producto_original1->save();
      }
      // SUMA AL STOCK LA CANTIDAD ESCRITA EN EL FORMULARIO AL NUEVO PRODUCTO QUE SE ESTA TOMANDO COMO SUSTITUTO DEL PRODUCTO QUE ESTA ASIGNADO DIRECTAMENTE AL ARMADO
      $producto_original2         = $this->productoRepo->getproductoFindWithTrashed($this->serviceCrypt->encrypt($sustituto->id_producto), []);
      if($producto_original2 != NULL) {
        $producto_original2->stock += $sustituto->cant;
        $producto_original2->save();
      }

      DB::commit();
      toastr()->success('¡Sustituto eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return back();
    } catch(\Exception $e) { DB::rollback(); throw $e; }
*/
  }
  public function verificarEstatusArmado($producto) {
    if($producto->armado->estat != config('app.en_espera_de_compra') AND $producto->armado->estat != config('app.en_revision_de_productos') ) {
      return abort(404);
    }
  }
}