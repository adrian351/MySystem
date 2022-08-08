<?php
namespace App\Repositories\almacen\producto\sustitutoProducto;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\almacen\producto\ProductoRepositories;
use DB;

class SustitutoProductoRepositories implements SustitutoProductoInterface {
  protected $serviceCrypt;
  protected $proveedorRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ProductoRepositories $productoRepositories) {
    $this->serviceCrypt = $serviceCrypt;
    $this->productoRepo = $productoRepositories;
  }
  public function store($request, $id_producto) {
    try { DB::beginTransaction();
      $producto = $this->productoRepo->getproductoFindOrFailById($id_producto, 'sustitutos');
      $producto->sustitutos()->attach($request->ids_sustituto);

      $id_producto = $this->serviceCrypt->decrypt($id_producto);
      foreach($request->ids_sustituto as $id_sustituto) {
        $id_sustituto = $this->serviceCrypt->encrypt($id_sustituto);
        $sustituto = $this->productoRepo->getproductoFindOrFailById($id_sustituto, 'sustitutos');
        $sustituto->sustitutos()->attach($id_producto);
      }

      DB::commit();
      return $producto;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_producto, $id_sustituto) {
    try { DB::beginTransaction();
      $id_sustituto = $this->serviceCrypt->decrypt($id_sustituto);
      $producto = $this->productoRepo->getproductoFindOrFailById($id_producto, 'sustitutos');
      $producto->sustitutos()->detach($id_sustituto);

      $id_producto = $this->serviceCrypt->decrypt($id_producto);
      $id_sustituto = $this->serviceCrypt->encrypt($id_sustituto);
      $sustituto = $this->productoRepo->getproductoFindOrFailById($id_sustituto, 'sustitutos');
      $sustituto->sustitutos()->detach($id_producto);

      DB::commit();
      return $producto;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}