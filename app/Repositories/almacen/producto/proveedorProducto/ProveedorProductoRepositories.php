<?php
namespace App\Repositories\almacen\producto\proveedorProducto;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\almacen\producto\ProductoRepositories;
use App\Repositories\servicio\calculo\CalculoRepositories;
use App\Repositories\armado\CalcularValoresArmadoRepositories;
use App\Repositories\cotizacion\CalcularValoresCotizacionRepositories;
// Otros
use DB;

class ProveedorProductoRepositories implements ProveedorProductoInterface {
  protected $serviceCrypt;
  protected $productoRepo;
  protected $calculoRepo;
  protected $calcularValoresArmadoRepo;
  protected $calcularValoresCotizacionRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ProductoRepositories $productoRepositories, CalculoRepositories $calculoRepositories, CalcularValoresArmadoRepositories $calcularValoresArmadoRepositories, CalcularValoresCotizacionRepositories $calcularValoresCotizacionRepositories) {
    $this->serviceCrypt                   = $serviceCrypt;
    $this->productoRepo                   = $productoRepositories;
    $this->calculoRepo                    = $calculoRepositories;
    $this->calcularValoresArmadoRepo      = $calcularValoresArmadoRepositories;
    $this->calcularValoresCotizacionRepo  = $calcularValoresCotizacionRepositories;
  }
  public function update($request, $id_producto, $id_proveedor) {
    DB::transaction(function() use($request, $id_producto, $id_proveedor) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $prec_clien = $this->calculoRepo->calcularUtilidad($request->precio_proveedor, $request->utilidad);
      $producto = $this->productoRepo->getproductoFindOrFailById($id_producto, ['proveedores', 'armados']);

      // Actualiza los datos de la tabla pivot
      $proveedores            = $producto->proveedores()->where('proveedores.id', $this->serviceCrypt->decrypt($id_proveedor))->first();
      $pivot                  = $proveedores->pivot;
      $pivot->prec_prove      = $request->precio_proveedor;
      $pivot->utilid          = $request->utilidad;
      $pivot->prec_clien      = $prec_clien;
      $pivot->produc          = $request->mombre_del_producto_que_maneja_el_proveedor;
      $pivot->cod_fabricante  = $request->codigo_de_fabricante;
      $pivot->tip_iva         = $request->iva;
      $pivot->ieps            = $request->ieps;
      $pivot->save();
    
      // Actualiza los datos del producto solo en caso de que el proveedor que se modifico sea el mismo al que tiene el producto
      if($producto->prove == $proveedores->nom_comerc) {
        $producto->prec_prove = $pivot->prec_prove;
        $producto->utilid     = $pivot->utilid;
        $prec_clien           = $this->calculoRepo->getUtilidadProducto($pivot->prec_prove, $pivot->utilid, $producto->cost_arm);
        $producto->prec_clien = $prec_clien;
        $producto->save();
        
        // CALCULA LOS NUEVOS PRECIOS Y VALORES DEL ARMADO
        $armados = $producto->armados()->withTrashed()->with('productos')->get();
        foreach($armados as $armado) {
          $this->calcularValoresArmadoRepo->calcularValoresArmado($armado, $armado->productos);
        }
        
        // CALCULA LOS NUEVOS PRECIOS Y VALORES DE LA COTIZACION
        $this->calcularValoresCotizacionRepo->calculaValoresCotizacionAlModificarProducto($producto);
      }
      return $producto;
    });
  }
  public function destroy($id_producto, $id_proveedor) {
    DB::transaction(function() use($id_producto, $id_proveedor) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $producto = $this->productoRepo->getproductoFindOrFailById($id_producto, ['proveedores', 'armados']);
      $proveedores = $producto->proveedores()->where('proveedores.id', $this->serviceCrypt->decrypt($id_proveedor))->first();

      // Actualiza los datos del producto solo en caso de que el proveedor que se elimino sea el mismo al que tiene el producto
      if($producto->prove == $proveedores->nom_comerc) {
        $producto->prove = null;
        $producto->prec_prove = $this->calculoRepo->bcdivDosDecimales(0);
        $producto->utilid = null;
        $producto->prec_clien = $this->calculoRepo->bcdivDosDecimales(0);
        $producto->save();

        // CALCULA LOS NUEVOS PRECIOS Y VALORES DEL ARMADO
        $armados = $producto->armados()->withTrashed()->with('productos')->get();
        foreach($armados as $armado) {
          $this->calcularValoresArmadoRepo->calcularValoresArmado($armado, $armado->productos);
        }
      }
      $producto->proveedores()->detach($this->serviceCrypt->decrypt($id_proveedor));
      return $producto;
    });
  }
}