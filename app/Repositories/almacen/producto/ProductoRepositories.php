<?php
namespace App\Repositories\almacen\producto;
// Models
use App\Models\Producto;
use App\Models\ReporteStock;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
use App\Repositories\servicio\calculo\CalculoRepositories;
use App\Repositories\armado\CalcularValoresArmadoRepositories;
use App\Repositories\cotizacion\CalcularValoresCotizacionRepositories;
use App\Repositories\almacen\producto\proveedorProducto\StoreProveedorProductoRepositories;
// Otros
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Storage;
use DB;

class ProductoRepositories implements ProductoInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  protected $calcularValoresArmadoRepo;
  protected $calculoRepo;
  protected $calcularValoresCotizacionRepo;
  protected $storeProveedorProductoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories, CalcularValoresArmadoRepositories $calcularValoresArmadoRepositories, CalculoRepositories $calculoRepositories, CalcularValoresCotizacionRepositories $calcularValoresCotizacionRepositories, StoreProveedorProductoRepositories $storeProveedorProductoRepositories) {
    $this->serviceCrypt                         = $serviceCrypt;
    $this->papeleraDeReciclajeRepo              = $papeleraDeReciclajeRepositories;
    $this->calcularValoresArmadoRepo            = $calcularValoresArmadoRepositories;
    $this->calculoRepo                          = $calculoRepositories;
    $this->calcularValoresCotizacionRepo        = $calcularValoresCotizacionRepositories;
    $this->storeProveedorProductoRepo           = $storeProveedorProductoRepositories;
  }
  public function productoAsignadoFindOrFailById($id_producto, $relaciones = null) {
    $id_producto = $this->serviceCrypt->decrypt($id_producto);
    $producto = Producto::with($relaciones)->asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->findOrFail($id_producto);
    return $producto;
  }
  public function getPagination($request){
    return Producto::with('sustitutos')->asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try { DB::beginTransaction();
      $producto                  = new Producto();
      $producto->produc          = $request->nombre_del_producto;
      $producto->pro_de_cat      = $request->es_producto_de_catalogo;
    //  $producto->cod_fabricante  = $request->codigo_de_fabricante;
    //  $producto->tip_iva         = $request->iva;
    //  $producto->ieps            = $request->ieps;
      $producto->min_vent        = $request->minimo_de_venta;
      $producto->publi_tie_gou   = $request->publicado_en_tienda_gourmet;
      $producto->marc            = $request->marca;
      $producto->tip             = $request->tipo;
      if($producto->tip == 'Canasta') {
        $producto->tam           = $request->tamano;
        $producto->alto          = $request->alto;
        $producto->ancho         = $request->ancho;
        $producto->largo         = $request->largo;
        $producto->cost_arm      = $request->costo_de_armado;
      } elseif($producto->tip == 'Producto') {
        $producto->tam           = null;
        $producto->alto          = $this->calculoRepo->bcdivDosDecimales(0.00);
        $producto->ancho         = $this->calculoRepo->bcdivDosDecimales(0.00);
        $producto->largo         = $this->calculoRepo->bcdivDosDecimales(0.00);
        $producto->cost_arm      = $this->calculoRepo->bcdivDosDecimales(0.00);
      }
      // $producto->categ           = $request->categoria;
    //  $producto->etiq            = $request->etiqueta;
      $producto->pes             = $request->peso;
      $producto->cod_barras      = $request->codigo_de_barras;
      $producto->min_stock      = $request->cantidad_minima_de_stock;
      $producto->desc_del_prod   = $request->descripcion_del_producto;
      $producto->asignado_prod   = Auth::user()->email_registro;
      $producto->created_at_prod = Auth::user()->email_registro;
      if($request->hasfile('imagen_del_producto')) {
        $imagen_blob = request()->file('imagen_del_producto');
        // Minimiza el tamaño de la imagen
        $img = Image::make($imagen_blob);
        $img_nom = $imagen_blob->getClientOriginalName();
        $img->resize(800, 800, function ($constraint) {
          $constraint->aspectRatio();
        });
        $imagen_blob_min = $img->stream()->detach();
        $nom = 'almacen/productos/'.date("Y").'/'.time().'min'.$img_nom;
        Storage::disk('s3')->put($nom, $imagen_blob_min, 'public');
        $producto->img_prod_rut = env('PREFIX');
        $producto->img_prod_nom = $nom;
      }
      $producto->save();

      // guardar las categorias
      $producto->categoria()->detach();
      $producto->categoria()->sync($request->categoria);

      $producto->subcategoria()->detach();
      $producto->subcategoria()->sync($request->subcategoria);

      $producto->etiqueta()->detach();
      $producto->etiqueta()->sync($request->etiqueta);

      // $producto->catalogos()->sync($request->etiqueta);
      $this->storeProveedorProductoRepo->store($request, $producto);
      
      $producto->sku            = 'PRO-'.$producto->id;
      // GUARDA LA INFORMACION DEL PROVEEDOR EN LOS CAMPOS DEL PRODUCTO
      $proveedor                = $producto->proveedores()->where('proveedores.id', $request->nombre_del_proveedor)->first();
      $producto->prove          = $proveedor->nom_comerc;
      $producto->prec_prove     = $proveedor->pivot->prec_prove;
      $producto->utilid         = $proveedor->pivot->utilid;
      $producto->prec_clien     = $this->calculoRepo->getUtilidadProducto($proveedor->pivot->prec_prove, $proveedor->pivot->utilid, $producto->cost_arm);
      $producto->save();

      $this->eliminarCacheAllProductosPlunk();
      
      DB::commit();
      return $producto;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function update($request, $id_producto) {
    DB::transaction(function() use($request, $id_producto) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $producto                 = $this->productoAsignadoFindOrFailById($id_producto, ['proveedores', 'armados']);
      $producto->produc         = $request->nombre_del_producto;
      $producto->pro_de_cat     = $request->es_producto_de_catalogo;
    //  $producto->cod_fabricante   = $request->codigo_de_fabricante;
    //  $producto->tip_iva         = $request->iva;
    //  $producto->ieps            = $request->ieps;
      $producto->min_vent        = $request->minimo_de_venta;
      $producto->publi_tie_gou   = $request->publicado_en_tienda_gourmet;
      $producto->marc           = $request->marca;
      if($producto->tip == 'Canasta') {
        $producto->tam          = $request->tamano;
        $producto->alto         = $request->alto;
        $producto->ancho        = $request->ancho;
        $producto->largo        = $request->largo;
        $producto->cost_arm     = $request->costo_de_armado;
      }
      $pivot                    = $producto->proveedores()->where('nom_comerc', $request->nombre_del_proveedor)->first()->pivot;
      $producto->prove          = $request->nombre_del_proveedor;
      $producto->prec_prove     = $pivot->prec_prove;
      $producto->utilid         = $pivot->utilid;
      $producto->prec_clien     = $this->calculoRepo->getUtilidadProducto($pivot->prec_prove, $pivot->utilid, $producto->cost_arm);
      // $producto->categ          = $request->categoria;
    //  $producto->etiq           = $request->etiqueta;
      $producto->pes            = $request->peso;
      $producto->cod_barras     = $request->codigo_de_barras;
      $producto->min_stock      = $request->cantidad_minima_de_stock;
      $producto->desc_del_prod  = $request->descripcion_del_producto;
      if($producto->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Productos', // Módulo
          'almacen.producto.show', // Nombre de la ruta
          $id_producto, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_producto), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Nombre del producto', 'Es producto de catálogo', 'Mínimo de venta', '¿Publicado en tienda gourmet?', 'Marca', 'Tamaño ', 'Alto', 'Ancho', 'Largo', 'Costo de armado', 'Nombre del proveedor', 'Precio proveedor', 'Utilidad', 'Precio cliente', 'Peso', 'Código de barras', 'Cantidad mínima de stock', 'Descripción del producto'), // Nombre de los inputs del formulario
          $producto, // Request
          array('produc', 'pro_de_cat', 'min_vent', 'publi_tie_gou', 'marc', 'tam', 'alto', 'ancho', 'largo', 'cost_arm', 'prove', 'prec_prove', 'utilid', 'prec_clien',  'pes', 'cod_barras', 'min_stock', 'desc_del_prod') // Nombre de los campos en la BD
        );
        $producto->updated_at_prod = Auth::user()->email_registro;
      }
      if($request->hasfile('imagen_del_producto')) {
        $imagen_blob = request()->file('imagen_del_producto');
        // Minimiza el tamaño de la imagen
        $img = Image::make($imagen_blob);
        $img_nom = $imagen_blob->getClientOriginalName();
        $img->resize(800, 800, function ($constraint) {
          $constraint->aspectRatio();
        });
        $imagen_blob_min = $img->stream()->detach();
        $nom = 'almacen/productos/'.date("Y").'/'.time().'min'.$img_nom;
        Storage::disk('s3')->put($nom, $imagen_blob_min, 'public');
        $producto->img_prod_rut = env('PREFIX');
        $producto->img_prod_nom = $nom;
      }
      $producto->save();
      // pasara las categorias
      $producto->categoria()->detach();
      $producto->categoria()->sync($request->categoria);

      $producto->subcategoria()->detach();
      $producto->subcategoria()->sync($request->subcategoria);

      // $producto->catalogos()->sync($request->etiqueta);
      $producto->etiqueta()->detach();
      $producto->etiqueta()->sync($request->etiqueta);

      // CALCULA LOS NUEVOS PRECIOS Y VALORES DEL ARMADO DE LA TABLA ARMADOS
      $armados = $producto->armados()->withTrashed()->with('productos')->get();
      foreach($armados as $armado) {
        $this->calcularValoresArmadoRepo->calcularValoresArmado($armado, $armado->productos);
      }
      
      // CALCULA LOS NUEVOS PRECIOS Y VALORES DEL ARMNADO Y LA COTIZACIÓN
      $this->calcularValoresCotizacionRepo->calculaValoresCotizacionAlModificarProducto($producto);

      $this->eliminarCacheAllProductosPlunk();
      return $producto;
    });
  }
  public function updateValidado($request, $id_producto) {
    try { DB::beginTransaction();
      $producto = $this->productoAsignadoFindOrFailById($id_producto, []);
      $producto->prod_valid  = $request->producto_validado;

      if($producto->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Productos', // Módulo
          'almacen.producto.show', // Nombre de la ruta
          $id_producto, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_producto), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('¿Producto validado?'), // Nombre de los inputs del formulario
          $producto, // Request
          array('prod_valid') // Nombre de los campos en la BD
        ); 
        $producto->updated_at_prod = Auth::user()->email_registro;
      }
      $producto->save();
      $this->eliminarCacheAllProductosPlunk();

      DB::commit();
      return $producto;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function updateHabilitado($request, $id_producto) {
    try { DB::beginTransaction();
      $producto = $this->productoAsignadoFindOrFailById($id_producto, []);
      $producto->hab_desh  = $request->habilitar_o_deshabilitar;

      if($producto->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Productos', // Módulo
          'almacen.producto.show', // Nombre de la ruta
          $id_producto, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_producto), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Habilitar o deshabilitar'), // Nombre de los inputs del formulario
          $producto, // Request
          array('hab_desh') // Nombre de los campos en la BD
        ); 
        $producto->updated_at_prod = Auth::user()->email_registro;
      }
      $producto->save();
      $this->eliminarCacheAllProductosPlunk();

      DB::commit();
      return $producto;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function aumentarStock($request, $id_producto) {
    // dd($request);
    $producto = $this->productoAsignadoFindOrFailById($id_producto, []);
   
    $producto->stock_temas += $request->aumentar_stock_temas;
    $producto->stock += $request->aumentar_stock_naucalpan;
    
    if(strlen($producto->stock) >= 10 || strlen($producto->stock_temas) >= 10) {return false;}
    if($producto->isDirty()) {
      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      ActividadRegistrada::dispatch(
        'Productos', // Módulo
        'almacen.producto.show', // Nombre de la ruta
        $id_producto, // Id del registro debe ir encriptado
        $this->serviceCrypt->decrypt($id_producto), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
        array('Aumentar stock naucalpan', 'Aumentar stock temas'), // Nombre de los inputs del formulario
        $producto, // Request
        array('stock', 'stock_temas') // Nombre de los campos en la BD
      ); 
      $producto->updated_at_prod = Auth::user()->email_registro;

      // GENERA REGISTRO PARA EL REPORTE DE STOCKS
      $reporte                = new ReporteStock();
      $reporte->reg           = $producto->produc;
      $reporte->email_usuario = Auth::user()->email_registro;
      if($request->aumentar_stock_temas == '' && $request->aumentar_stock_naucalpan != ''){
        $reporte->acc           = 'aumentarStockNaucalpan';
        $reporte->stock_ant     = $producto->getOriginal('stock');
        $reporte->stock_nuev    = $producto->getAttribute('stock');
        $reporte->dif           = $request->aumentar_stock_naucalpan;
      }else if($request->aumentar_stock_temas != '' && $request->aumentar_stock_naucalpan == ''){
        $reporte->acc           = 'aumentarStockTemas';
        $reporte->stock_ant     = $producto->getOriginal('stock_temas');
        $reporte->stock_nuev    = $producto->getAttribute('stock_temas');
        $reporte->dif           = $request->aumentar_stock_temas;
      }
      $reporte->save();
    }
    $producto->save();
    return $producto;
  }
  public function disminuirStock($request, $id_producto) {
    $producto = $this->productoAsignadoFindOrFailById($id_producto, []);
    $producto->stock -= $request->disminuir_stock_naucalpan;
    $producto->stock_temas -= $request->disminuir_stock_temas;
    if($producto->stock < 0 || $producto->stock_temas < 0) {return false;}
    if($producto->isDirty()) {
      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      ActividadRegistrada::dispatch(
        'Productos', // Módulo
        'almacen.producto.show', // Nombre de la ruta
        $id_producto, // Id del registro debe ir encriptado
        $this->serviceCrypt->decrypt($id_producto), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
        array('Disminuir stock naucalpan', 'Dismunir stock temas'), // Nombre de los inputs del formulario
        $producto, // Request
        array('stock', 'stock_temas') // Nombre de los campos en la BD
      ); 
      $producto->updated_at_prod = Auth::user()->email_registro;

      // GENERA REGISTRO PARA EL REPORTE DE STOCKS
      $reporte                = new ReporteStock();
      $reporte->reg           = $producto->produc;
      $reporte->email_usuario = Auth::user()->email_registro;
      if($request->disminuir_stock_temas == '' && $request->disminuir_stock_naucalpan != ''){
        $reporte->acc           = 'disminuirStockNaucalpan';
        $reporte->stock_ant     = $producto->getOriginal('stock');
        $reporte->stock_nuev    = $producto->getAttribute('stock');
        $reporte->dif           = $request->disminuir_stock_naucalpan;
      }else if($request->disminuir_stock_temas != '' && $request->aumentar_stock_naucalpan == ''){
        $reporte->acc           = 'disminuirStockTemas';
        $reporte->stock_ant     = $producto->getOriginal('stock_temas');
        $reporte->stock_nuev    = $producto->getAttribute('stock_temas');
        $reporte->dif           = $request->disminuir_stock_temas;
      }

      $reporte->save();
    }
    $producto->save();
    return $producto;
  }
  public function destroy($id_producto) {
    try { DB::beginTransaction();
      $producto = $this->productoAsignadoFindOrFailById($id_producto, 'armados');
      $producto->categoria()->detach();
      $producto->delete();
      $armados = $producto->armados()->withTrashed()->with('productos')->get();
      $producto->armados()->detach();
      $producto->etiqueta()->detach();
      // $armado->etiqueta()->detach($this->serviceCrypt->decrypt($id_producto));

      // CALCULA LOS NUEVOS PRECIOS Y VALORES DEL ARMADO
      foreach($armados as $armado) {
        $this->calcularValoresArmadoRepo->calcularValoresArmado($armado, $armado->productos);
      }
      $this->eliminarCacheAllProductosPlunk();
      
      // Manda el registro a la papelera de reciclaje
      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Productos', // Nombre del módulo del sistema
        'registro'    => $producto->produc, // Información a mostrar en la papelera
        'tab'         => 'productos', // Nombre de la tabla en la BD
        'id_reg'      => $producto->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación           
      ]);
      DB::commit();
      return $producto;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getSustitutosProducto($producto, $request) {
    if($request->opcion_buscador != null) {
      return $producto->sustitutos()->with('sustitutos')->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $producto->sustitutos()->with('sustitutos')->paginate($request->paginador);
  }
  public function getproductoFindOrFailById($id_producto, $relaciones) {
    $id_producto = $this->serviceCrypt->decrypt($id_producto);
    $producto = Producto::with($relaciones)->findOrFail($id_producto);
    return $producto;
  }
  public function getproductoFindWithTrashed($id_producto, $relaciones) {
    $id_producto = $this->serviceCrypt->decrypt($id_producto);
    $producto = Producto::with($relaciones)->withTrashed()->find($id_producto);
    return $producto; 
  }
  public function getproductoFindById($id_producto, $relaciones) {
    $id_producto = $this->serviceCrypt->decrypt($id_producto);
    $producto = Producto::with($relaciones)->find($id_producto);
    return $producto;
  }
  public function eliminarCacheAllProductosPlunk() {
    Cache::pull('allProductosPlunk'); // Elimina la cache con el nombre espesificado
  }
  public function getAllProductosPlunk() {
    $productos = Cache::rememberForever('allProductosPlunk', function() { // Guarda la información en la cache con la llave "sistema"
      return Producto::orderBy('produc', 'ASC')->pluck('produc', 'id');
    });
    return $productos; 
  }
  // Devuelve todos los registros de la tabla productos a excepción de los que se espesifiquen
  public function getAllSustitutosOrProductosPlunkMenos($sustitutos_o_productos, $opcion) {
    return Producto::where('hab_desh', 'Habilitado')->where(function($query) use($sustitutos_o_productos, $opcion) {
      $hastaC = count($sustitutos_o_productos) -1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        if($opcion == 'original') {
          $query->where('id', '!=', $sustitutos_o_productos[$contador2]->id);
        } elseif($opcion == 'copia') {
          $query->where('id', '!=', $sustitutos_o_productos[$contador2]->id_producto);
        }
      }
    })->orderBy('produc', 'ASC')->pluck('produc', 'id');
  }
  public function getAllSustitutosOrProductosMenos($sustitutos_o_productos, $opcion) {
    return Producto::where('hab_desh', 'Habilitado')->where(function($query) use($sustitutos_o_productos, $opcion) {
      $hastaC = count($sustitutos_o_productos) -1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        if($opcion == 'original') {
          $query->where('id', '!=', $sustitutos_o_productos[$contador2]->id);
        } elseif($opcion == 'copia') {
          $query->where('id', '!=', $sustitutos_o_productos[$contador2]->id_producto);
        }
      }
    })->orderBy('produc', 'ASC')->get(['id', 'produc', 'prec_prove', 'prec_clien', 'pro_de_cat']);
  }
  public function getProductosFindOrFail($ids_productos, $hastaC) {
    for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
      $productos[$contador2] = Producto::select('prec_clien', 'pes', 'alto', 'ancho', 'largo')->where('id', $ids_productos[$contador2])->first();
    }
    return $productos;
  }
  public function getExistenciaEquivalentePorProducto($sustitutos) {
    $existencia_equivalente = 0;
    foreach($sustitutos as $sustituto) {
      $existencia_equivalente += $sustituto->stock;
    }
    return $existencia_equivalente;
  }
  public function getProveedoresProducto($producto, $request) {
    if($request->opcion_buscador != null) {
      return $producto->proveedores()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $producto->proveedores()->paginate($request->paginador);
  }
  public function getPreciosProducto($producto, $request) {
    if($request->opcion_buscador != null) {
      return $producto->precios()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $producto->precios()->paginate($request->paginador);
  }


  // public function productosVendidos(){
    // $ven = Producto::with(['sustitutos', 'productos_pedido' => function($query) {
    //   $query->with(['armado' => function($query) {
    //       $query->whereDate('created_at', '>', '2021-10-01');
    //   }]);
    // }])->orderBy('id', 'DESC')->get();

  //     $ven = Producto::with('productos_pedido')->whereDate('created_at', '>' ,'2021-10-01')->get();

      
  //   return $ven;
  // }
}