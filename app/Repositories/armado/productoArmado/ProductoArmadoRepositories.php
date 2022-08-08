<?php
namespace App\Repositories\armado\productoArmado;
// Repositories
use App\Repositories\armado\ArmadoRepositories;
use App\Repositories\almacen\producto\ProductoRepositories;
use App\Repositories\armado\CalcularValoresArmadoRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use DB;

class ProductoArmadoRepositories implements ProductoArmadoInterface {
  protected $serviceCrypt;
  protected $armadoRepo;
  protected $productoRepo;
  protected $calcularValoresArmadoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ArmadoRepositories $armadoRepositories, ProductoRepositories $productoRepositories, CalcularValoresArmadoRepositories $calcularValoresArmadoRepositories) {
    $this->serviceCrypt               = $serviceCrypt;
    $this->armadoRepo                 = $armadoRepositories;
    $this->productoRepo               = $productoRepositories;
    $this->calcularValoresArmadoRepo  = $calcularValoresArmadoRepositories;
  }
  public function store($request, $id_armado) {
    DB::transaction(function() use($request, $id_armado) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $armado = $this->armadoRepo->getArmadoFindOrFail($this->serviceCrypt->decrypt($id_armado));
      $armado->productos()->attach($request->ids_productos);
      // $productos_list = $this->productoRepo->getAllSustitutosOrProductosMenos($armado->productos, 'original');
      // GENERA LOS NUEVOS VALORES PARA EL ARMADO
      $armado = $this->calcularValoresArmadoRepo->calcularValoresArmado($armado, $armado->productos()->get());
      return $armado;
    });
  }
  public function destroy($id_armado, $id_producto) {
    DB::transaction(function() use($id_armado, $id_producto) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $producto = $this->productoRepo->getproductoFindOrFailById($id_producto, 'armados');
      $armado   = $producto->armados()->findOrFail($this->serviceCrypt->decrypt($id_armado));
      $armado->productos()->detach($this->serviceCrypt->decrypt($id_producto));

      // GENERA LOS NUEVOS VALORES PARA EL ARMADO
      $armado = $this->calcularValoresArmadoRepo->calcularValoresArmado($armado, $armado->productos);
      return $armado;
    });
  }
  public function editCantidad($request, $id_producto, $id_armado) {
    DB::transaction(function() use($request, $id_producto, $id_armado) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $producto = $this->productoRepo->getproductoFindOrFailById($id_producto, 'armados');
      $armado   = $producto->armados()->findOrFail($this->serviceCrypt->decrypt($id_armado));

      // GUARDA LA CANTIDAD DE PRODUCTOS
      $armado->pivot->cant    = $request->cantidad;
      $armado->pivot->save();

      // GENERA LOS NUEVOS VALORES PARA EL ARMADO
      $armado = $this->calcularValoresArmadoRepo->calcularValoresArmado($armado, $armado->productos);
    });
  }
}