<?php
namespace App\Repositories\almacen\producto\precio;
// Models
use App\Models\PrecioPorYear;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\almacen\producto\ProductoRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class PrecioRepositories implements PrecioInterface {
  protected $serviceCrypt;
  protected $productoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ProductoRepositories $productoRepositories) {
    $this->serviceCrypt                   = $serviceCrypt;
    $this->productoRepo                   = $productoRepositories;
  }
  public function precioFindOrFailById($id_precio, $relaciones) {
    $id_precio = $this->serviceCrypt->decrypt($id_precio);
    $precio = PrecioPorYear::with($relaciones)->findOrFail($id_precio);
    return $precio;
  }
  public function store($request, $id_producto) {
    try { DB::beginTransaction();
      $precio                 = new PrecioPorYear();
      $precio->year           = $request->ano;
      $precio->prec           = $request->precio;
      $precio->producto_id    = $this->serviceCrypt->decrypt($id_producto);
      $precio->created_at_pre = Auth::user()->email_registro;
      $precio->save();

      DB::commit();
      return $precio;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_precio) {
    try { DB::beginTransaction();
      $precio = $this->precioFindOrFailById($id_precio, []);
      $precio->forceDelete();

      DB::commit();
      return $precio;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}