<?php
namespace App\Repositories\cotizacion\armadoCotizacion\productoArmado;
// Models
use App\Models\CotizacionArmadoProductos;
// Repositories
use App\Repositories\almacen\producto\ProductoRepositories;
use App\Repositories\cotizacion\CotizacionRepositories;
use App\Repositories\cotizacion\armadoCotizacion\ArmadoCotizacionRepositories;
use App\Repositories\armado\CalcularValoresArmadoRepositories;
use App\Repositories\cotizacion\armadoCotizacion\productoArmado\StoreFilesRepositories;
use App\Repositories\cotizacion\CalcularValoresCotizacionRepositories;
use App\Repositories\cotizacion\armadoCotizacion\CalcularValoresArmadoCotizacionRepositories;
use App\Repositories\servicio\calculo\CalculoRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use DB;

class ProductoArmadoRepositories implements ProductoArmadoInterface {
  protected $serviceCrypt;
  protected $productoRepo;
  protected $cotizacionRepo;
  protected $armadoCotizacionRepo;
  protected $calcularValoresArmadoRepo;
  protected $storeFilesRepo;
  protected $calcularValoresCotizacionRepo;
  protected $calcularValoresArmadoCotizacionRepo;
  protected $calculoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ProductoRepositories $productoRepositories, CotizacionRepositories $cotizacionRepositories, ArmadoCotizacionRepositories $armadoCotizacionRepositories, CalcularValoresArmadoRepositories $calcularValoresArmadoRepositories, StoreFilesRepositories $storeFilesRepositories, CalcularValoresCotizacionRepositories $calcularValoresCotizacionRepositories, CalcularValoresArmadoCotizacionRepositories $calcularValoresArmadoCotizacionRepositories, CalculoRepositories $calculoRepositories) {
    $this->serviceCrypt                         = $serviceCrypt;
    $this->productoRepo                         = $productoRepositories;
    $this->cotizacionRepo                       = $cotizacionRepositories;
    $this->armadoCotizacionRepo                 = $armadoCotizacionRepositories;
    $this->calcularValoresArmadoRepo            = $calcularValoresArmadoRepositories;
    $this->storeFilesRepo                       = $storeFilesRepositories;
    $this->calcularValoresCotizacionRepo        = $calcularValoresCotizacionRepositories;
    $this->calcularValoresArmadoCotizacionRepo  = $calcularValoresArmadoCotizacionRepositories;
    $this->calculoRepo                          = $calculoRepositories;
  }
  public function getproductoFindOrFailById($id_producto, $relaciones = null) {
    $id_producto  = $this->serviceCrypt->decrypt($id_producto);
    $producto     = CotizacionArmadoProductos::with($relaciones)->findOrFail($id_producto);
    return $producto;
  }
  public function store($request, $id_armado) {
    DB::transaction(function() use($request, $id_armado) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $armado     = $this->armadoCotizacionRepo->armadoFindOrFailById($id_armado, ['cotizacion', 'productos']);
      $this->armadoCotizacionRepo->verificarElEstatusDeLaCotizacion($armado->cotizacion->estat);
      $cotizacion = $armado->cotizacion()->with('cliente')->first();
      
      // GUARDA EL PRODUCTO AL ARMADO
      $producto = $this->productoRepo->getproductoFindOrFailById($this->serviceCrypt->encrypt($request->id_producto), []);
      $this->storeFilesRepo->storeProductos([0 => $producto], $armado->id);

      // GENERA LOS NUEVOS VALORES PARA EL ARMADO
      $armado = $this->armadoCotizacionRepo->verificarSiYaFueModificado($armado, $cotizacion);
      $armado = $this->calcularValoresArmadoRepo->calcularValoresArmado($armado, $armado->productos()->get());
      $armado = $this->calcularValoresArmadoCotizacionRepo->sumaValoresArmadoCotizacion($armado);
      $armado->save();
      
      // GENERA LOS NUEVOS VALORES PARA LA COTIZACIÓN
      $this->calcularValoresCotizacionRepo->calculaValoresCotizacion($armado->cotizacion);
      
      return $producto;
    });
  }
  public function destroy($id_producto) {
    try { DB::beginTransaction();
      $producto   = $this->getproductoFindOrFailById($id_producto, 'armado');
      $armado     = $producto->armado()->with('cotizacion', 'productos')->first();
      $this->armadoCotizacionRepo->verificarElEstatusDeLaCotizacion($armado->cotizacion->estat);
      $cotizacion = $armado->cotizacion()->with('cliente')->first();

      // ELIMINA EL PRODUCTO DE DEL ARMADO
      $producto->forceDelete();
            
      // GENERA LOS NUEVOS VALORES PARA EL ARMADO
      $armado = $this->armadoCotizacionRepo->verificarSiYaFueModificado($armado, $cotizacion);
      $armado = $this->calcularValoresArmadoRepo->calcularValoresArmado($armado, $armado->productos()->get());
      $armado = $this->calcularValoresArmadoCotizacionRepo->sumaValoresArmadoCotizacion($armado);
      $armado->save();

      // GENERA LOS NUEVOS VALORES PARA LA COTIZACIÓN
      $this->calcularValoresCotizacionRepo->calculaValoresCotizacion($cotizacion);

      // IMPORTANTE NO SE IMPLEMENTARA PAPELERA DE RECICLAJE (POR LOS PRECIOS DE LOS ARMADOS RELACIONADOS A LA COTIZACIÓN)
      
      DB::commit();
      return $producto;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function updateCantidad($request, $id_producto) {
    try { DB::beginTransaction();
      $producto   = $this->getproductoFindOrFailById($id_producto, 'armado');
      $armado     = $producto->armado()->with('cotizacion', 'productos')->first();
      $this->armadoCotizacionRepo->verificarElEstatusDeLaCotizacion($armado->cotizacion->estat);
      $cotizacion = $armado->cotizacion()->with('cliente')->first();
      
      // GUARDA LA CANTIDAD DE PRODUCTOS
      $producto->cant = $request->cantidad_producto;
      $producto->save();
            
      // GENERA LOS NUEVOS VALORES PARA EL ARMADO
      $armado = $this->armadoCotizacionRepo->verificarSiYaFueModificado($armado, $cotizacion);
      $armado = $this->calcularValoresArmadoRepo->calcularValoresArmado($armado, $armado->productos()->get());
      $armado = $this->calcularValoresArmadoCotizacionRepo->sumaValoresArmadoCotizacion($armado);
      $armado->save();

      // GENERA LOS NUEVOS VALORES PARA LA COTIZACIÓN
      $this->calcularValoresCotizacionRepo->calculaValoresCotizacion($cotizacion);

      DB::commit();
      return $producto;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function updateUtilidad($request, $id_producto) {
    try { DB::beginTransaction();
      $producto   = $this->getproductoFindOrFailById($id_producto, 'armado');
      $armado     = $producto->armado()->with('cotizacion', 'productos')->first();
      $this->armadoCotizacionRepo->verificarElEstatusDeLaCotizacion($armado->cotizacion->estat);
      $cotizacion = $armado->cotizacion()->with('cliente')->first();

      // GUARDA LA UTILIDAD DEL PRODUCTO
      $producto->utilid = $request->utilidad;
      $producto->prec_clien = $this->calculoRepo->getUtilidadProducto($producto->prec_prove, $producto->utilid, $producto->cost_arm);
      $producto->save();
            
      // GENERA LOS NUEVOS VALORES PARA EL ARMADO
      $armado = $this->armadoCotizacionRepo->verificarSiYaFueModificado($armado, $cotizacion);
      $armado = $this->calcularValoresArmadoRepo->calcularValoresArmado($armado, $armado->productos()->get());
      $armado = $this->calcularValoresArmadoCotizacionRepo->sumaValoresArmadoCotizacion($armado);
      $armado->save();

      // GENERA LOS NUEVOS VALORES PARA LA COTIZACIÓN
      $this->calcularValoresCotizacionRepo->calculaValoresCotizacion($cotizacion);

      $producto->save();     
      DB::commit();
      return $producto;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}