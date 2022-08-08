<?php
namespace App\Http\Controllers\Almacen\Producto;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\almacen\producto\StoreProductoRequest;
use App\Http\Requests\almacen\producto\UpdateProductoRequest;
use App\Http\Requests\almacen\producto\UpdateAumentarStockRequest;
use App\Http\Requests\almacen\producto\UpdateDisminuirStockRequest;
use App\Http\Requests\almacen\producto\UpdateValidadoProductoRequest;
use App\Http\Requests\almacen\producto\UpdateHabilitadoProductoRequest;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\almacen\producto\ProductoRepositories;
use App\Repositories\servicio\archivoGenerado\ArchivoGeneradoRepositories;
use App\Repositories\sistema\catalogo\CatalogoRepositories;
use App\Repositories\proveedor\ProveedorRepositories;

// pruba para eliminar productos
  use App\Repositories\armado\ArmadoRepositories;
use App\Repositories\cotizacion\CotizacionRepositories;
use App\Models\Cotizacion;
// use App\Models\Armado;

// importar las categorias
// use App\Http\Controllers\Categoria\CategoriaController;
use App\Repositories\categoria\CategoriaRepositories;
use App\Repositories\subCategoria\SubCategoriaRepositories;
use App\Repositories\etiqueta\EtiquetaRepositories;

class ProductoController extends Controller {
  protected $serviceCrypt;
  protected $productoRepo;
  protected $catalogoRepo;
  protected $proveedorRepo;
  protected $categoriaRepo;
  protected $sub_categoriaRepo;
  protected $etiRepo;

  protected $armadoRepo;
  protected $cotizacionRepo;


  public function __construct(ServiceCrypt $serviceCrypt, ProductoRepositories $productoRepositories, CatalogoRepositories $catalogoRepositories, ProveedorRepositories $proveedorRepositories, CategoriaRepositories $categoriaRepositories, SubCategoriaRepositories $subCategoriaRepositories, ArmadoRepositories $armadoRepositories, CotizacionRepositories $cotizacionRepositories, EtiquetaRepositories $etiquetaRepositories) {
    
    $this->serviceCrypt   = $serviceCrypt;
    $this->productoRepo   = $productoRepositories;
    $this->catalogoRepo   = $catalogoRepositories;
    $this->proveedorRepo  = $proveedorRepositories;
    $this->categoriaRepo    =$categoriaRepositories;
    $this->sub_categoriaRepo = $subCategoriaRepositories;
    $this->etiRepo          = $etiquetaRepositories;
    $this->armadoRepo = $armadoRepositories;
    $this->cotizacionRepo = $cotizacionRepositories;
  }
  public function index(Request $request) {
    $productos = $this->productoRepo->getPagination($request);
    $armados = $this->armadoRepo->getArmadoFindOrFail($request);
    $cotizacion =  Cotizacion::with('armados')->findOrFail($request);
    return view('almacen.producto.alm_pro_index', compact('productos', 'armados', 'cotizacion'

  ));
  }
  public function create() {
    $etiquetas_list     = $this->catalogoRepo->getAllIdCatalogosPlunk('Productos (Etiqueta)');
    $marca_list         = $this->catalogoRepo->getAllInputCatalogosPlunk('Productos (Marca)');
    $proveedores_list   = $this->proveedorRepo->getAllProveedoresPlunkId();
    $categorias_list    = $this->categoriaRepo->Only_Categorias();
    $subcat_list        = $this->sub_categoriaRepo->Only_SubCategorias();
    $etiquetas_list     = $this->etiRepo->Only_Etiquetas();
    return view('almacen.producto.alm_pro_create', compact( 'etiquetas_list','categorias_list', 'marca_list', 'subcat_list', 'proveedores_list', 'etiquetas_list'));

  }
  public function store(StoreProductoRequest $request) {
    $producto = $this->productoRepo->store($request);
    if(auth()->user()->can('almacen.producto.edit')) {
      toastr()->success('¡Producto registrado exitosamente ahora puedes registrar sus proveedores!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return redirect(route('almacen.producto.edit', $this->serviceCrypt->encrypt($producto->id))); 
    }
    toastr()->success('¡Producto registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_producto) {
    $producto               = $this->productoRepo->productoAsignadoFindOrFailById($id_producto, ['sustitutos', 'proveedores', 'imagenes']);
    $imagenes               = $producto->imagenes()->paginate(99999999);
    $precios                = $this->productoRepo->getPreciosProducto($producto, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $sustitutos             = $this->productoRepo->getSustitutosProducto($producto, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $proveedores            = $this->productoRepo->getProveedoresProducto($producto, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $existencia_equivalente = $this->productoRepo->getExistenciaEquivalentePorProducto($sustitutos);
    return view('almacen.producto.alm_pro_show', compact('producto', 'imagenes', 'precios', 'existencia_equivalente', 'sustitutos', 'proveedores'));
  }
  public function edit($id_producto) {
    $producto               = $this->productoRepo->productoAsignadoFindOrFailById($id_producto, ['precios', 'sustitutos', 'proveedores', 'catalogos', 'imagenes']);
    $imagenes               = $producto->imagenes()->paginate(99999999);
    $precios                = $this->productoRepo->getPreciosProducto($producto, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $sustitutos_list        = $this->productoRepo->getAllSustitutosOrProductosPlunkMenos($producto->sustitutos, 'original');
    $sustitutos             = $this->productoRepo->getSustitutosProducto($producto, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $proveedores            = $this->productoRepo->getProveedoresProducto($producto, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $proveedores_list       = $producto->proveedores()->orderBy('nom_comerc', 'ASC')->pluck('nom_comerc', 'nom_comerc');
    $proveedores_list[$producto->prove] = $producto->prove;
    $existencia_equivalente = $this->productoRepo->getExistenciaEquivalentePorProducto($sustitutos);
    $etiquetas_list         = $this->catalogoRepo->getAllIdCatalogosPlunk('Productos (Etiqueta)');
    $etiquetas_list[$producto->etiq] = $producto->etiq;
    $marca_list             = $this->catalogoRepo->getAllInputCatalogosPlunk('Productos (Marca)');
    $marca_list[$producto->marc] = $producto->marc;
    $categorias_list = $this->categoriaRepo->Only_Categorias();
    $subcat_list = $this->sub_categoriaRepo->Only_SubCategorias();
    $etiquetas_list     = $this->etiRepo->Only_Etiquetas();

    return view('almacen.producto.alm_pro_edit', compact('producto', 'imagenes', 'precios', 'existencia_equivalente', 'proveedores', 'proveedores_list', 'sustitutos_list', 'sustitutos',  'etiquetas_list', 'marca_list','categorias_list', 'subcat_list', 'etiquetas_list'));
  }
  public function update(UpdateProductoRequest $request, $id_producto) {
    $this->productoRepo->update($request, $id_producto);
    toastr()->success('¡Producto actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function updateValidado(UpdateValidadoProductoRequest $request, $id_producto) {
    $this->productoRepo->updateValidado($request, $id_producto);
    toastr()->success('¡Producto actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function updateHabilitado(UpdateHabilitadoProductoRequest $request, $id_producto) {
    $this->productoRepo->updateHabilitado($request, $id_producto);
    toastr()->success('¡Producto actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function aumentarStock(UpdateAumentarStockRequest $request, $id_producto) {
    $respuesta = $this->productoRepo->aumentarStock($request, $id_producto);
    if($respuesta == false) {
      toastr()->error('¡El valor que se ingreso no fue aceptado!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    } else {
      toastr()->success('¡Stock aumentado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    }
    return back();
  }
  public function disminuirStock(UpdateDisminuirStockRequest $request, $id_producto) {
    $respuesta = $this->productoRepo->disminuirStock($request, $id_producto);
    if($respuesta == false) {
      toastr()->error('¡El valor que se ingreso no fue aceptado!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    } else {
      toastr()->success('¡Stock disminuido exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    }
    return back();
  }
  public function destroy($id_producto) {
    $this->productoRepo->destroy($id_producto);
    toastr()->success('¡Producto eliminado exitosamenste!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function generarReporteDeProducto(ArchivoGeneradoRepositories $archivoGeneradoRepo){
    return (new \App\Exports\almacen\producto\generarReporteDeProductoExport)->download('ReporteDeProductos-'.date('Y-m-d').'.xlsx');
  }

  public function generarReporteDeSustitutos(ArchivoGeneradoRepositories $archivoGeneradoRepo){
    return (new \App\Exports\almacen\producto\generarReporteDeSustitutoExport)->download('ReporteDeSustitutos-'.date('Y-m-d').'.xlsx');
  }

  public function generarReporteDeCompra(Request $request) {
    if($request->fecha_1 != null && $request->fecha_2 != null){
      return (new \App\Exports\almacen\producto\generarReporteDeCompraExport(
        $request->fecha_1,
        $request->fecha_2,
        $request->fecha
      ))->download('ReporteDeCompra-'.date('Y-m-d').'.xlsx');

    }elseif($request->fecha != null){
      return (new \App\Exports\almacen\producto\generarReporteDeCompraExport(
        $request->fecha_1,
        $request->fecha_2,
        $request->fecha
      ))->download('ReporteDeCompra-'.date('Y-m-d').'.xlsx');
    }else{
      toastr('¡Ingrese los datos correctamente!', 'error');
      return back();
    }

    // return (new \App\Exports\almacen\producto\generarReporteDeCompraExport(
    //   $request->fecha_1,
    //   $request->fecha_2,
    //   $request->fecha
    // ))->download('ReporteDeCompra-'.date('Y-m-d').'.xlsx');


    
    
  /*
    $info_archivo = (object) [
      'tip'             => 'XLSX', // Tipo de archivo (JPG, PNG, PDF, XLM, XLSX, ETC) siempre en mayusculas
      'arch_rut'        => env('PREFIX'), // Ruta de donde se guardara el archivo (Mismo que se espesifica en el archivo config/filesystems.php)
      'arch_nom'        => 'almacen/productos/archivosGenerados/ReporteDeCompra-' . date('Y-m-d') . '-' . time() . '.xlsx', // Nombre del archivo
      'arch_nom_abrev'  => 'ReporteDeCompra-' . date('Y-m-d'), // Nombre del archivo abreviado para mostrar en la campana de notificaciones
      'filesystems'     => 's3' // Nombre de la fuction espesificada en el archivo config/filesystems.php la cual se encargara de espesificar la ruta donde se guardara el archivo
    ];
    $tipo = 'generarReporteDeCompraExport'; // Nombre del archivo App\Exports\...
    $archivoGeneradoRepo->store($info_archivo, $tipo);
    toastr()->success('¡El reporte se esta generando una vez que haya terminado se mostrará en la barra superior!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  */
  }
  // generar reporte de stock
  public function generarReporteDeStock(ArchivoGeneradoRepositories $archivoGeneradoRepo) {
    return (new \App\Exports\almacen\producto\generarReporteDeStockExport)->download('ReporteDeStock-'.date('Y-m-d').'.xlsx');

    // descarga el excel y lo almacena en la barra superior
    /*
    $info_archivo = (object) [
      'tip'             => 'XLSX', // Tipo de archivo (JPG, PNG, PDF, XLM, XLSX, ETC) siempre en mayusculas
      'arch_rut'        => env('PREFIX'), // Ruta de donde se guardara el archivo (Mismo que se espesifica en el archivo config/filesystems.php)
      'arch_nom'        => 'almacen/productos/archivosGenerados/ReporteDeStock-' . date('Y-m-d') . '-' . time() . '.xlsx', // Nombre del archivo
      'arch_nom_abrev'  => 'ReporteDeStock-' . date('Y-m-d'), // Nombre del archivo abreviado para mostrar en la campana de notificaciones
      'filesystems'     => 's3' // Nombre de la fuction espesificada en el archivo config/filesystems.php la cual se encargara de espesificar la ruta donde se guardara el archivo
    ];
    $tipo = 'generarReporteDeStockExport'; // Nombre del archivo App\Exports\...
    $archivoGeneradoRepo->store($info_archivo, $tipo);
    toastr()->success('¡El reporte se esta generando una vez que haya terminado se mostrará en la barra superior!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
    */
  }
  public function getPrecioProveedor(Request $request) {
    if($request->ajax()) {
      $producto = $this->productoRepo->productoAsignadoFindOrFailById($request->id_producto, 'proveedores');
      $pivot    = $producto->proveedores()->where('nom_comerc', $request->nombre_del_proveedor)->first()->pivot;
      return response()->json($pivot);
    }
  }
}