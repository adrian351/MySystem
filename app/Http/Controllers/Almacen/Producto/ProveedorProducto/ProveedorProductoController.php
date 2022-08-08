<?php
namespace App\Http\Controllers\Almacen\Producto\ProveedorProducto;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\almacen\producto\proveedorProducto\StoreProveedorProductoRequest;
use App\Http\Requests\almacen\producto\proveedorProducto\UpdateProveedorProductoRequest;
// Repositories
use App\Repositories\almacen\producto\ProductoRepositories;
use App\Repositories\proveedor\ProveedorRepositories;
use App\Repositories\almacen\producto\proveedorProducto\ProveedorProductoRepositories;
use App\Repositories\almacen\producto\proveedorProducto\StoreProveedorProductoRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class ProveedorProductoController extends Controller {
  protected $serviceCrypt;
  protected $productoRepo;
  protected $proveedorRepo;
  protected $proveedorProductoRepo;
  protected $storeProveedorProductoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ProductoRepositories $productoRepositories, ProveedorRepositories $proveedorRepositories, ProveedorProductoRepositories $proveedorProductoRepositories, StoreProveedorProductoRepositories $storeProveedorProductoRepositories) {
    $this->serviceCrypt               = $serviceCrypt;
    $this->productoRepo               = $productoRepositories;
    $this->proveedorRepo              = $proveedorRepositories;
    $this->proveedorProductoRepo      = $proveedorProductoRepositories;
    $this->storeProveedorProductoRepo = $storeProveedorProductoRepositories;
  }
  public function create($id_producto) {
    $producto           = $this->productoRepo->productoAsignadoFindOrFailById($id_producto, 'proveedores');
    $proveedores_list   = $this->proveedorRepo->getAllProveedoresPlunkMenos($producto->proveedores);
    return view('almacen.producto.proveedor_producto.alm_pro_proPro_create', compact('producto', 'proveedores_list'));
  }
  public function store(StoreProveedorProductoRequest $request, $id_producto) {
    $producto           = $this->productoRepo->getproductoFindOrFailById($id_producto, 'proveedores');
    $this->storeProveedorProductoRepo->store($request, $producto);
    toastr()->success('¡Proveedor registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function edit($id_producto, $id_proveedor) {
    $producto           = $this->productoRepo->getproductoFindOrFailById($id_producto, 'proveedores');
    $proveedor_producto = $producto->proveedores()->where('proveedor_id', $this->serviceCrypt->decrypt($id_proveedor))->first();
    if ($proveedor_producto === null) { return abort(404); }
    return view('almacen.producto.proveedor_producto.alm_pro_proPro_edit', compact('producto', 'proveedor_producto'));
  }
  public function update(UpdateProveedorProductoRequest $request, $id_producto, $id_proveedor) {
    $this->proveedorProductoRepo->update($request, $id_producto, $id_proveedor);
    toastr()->success('¡Proveedor actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_producto, $id_proveedor) {
    $this->proveedorProductoRepo->destroy($id_producto, $id_proveedor);
    toastr()->success('¡Proveedor eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}