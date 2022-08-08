<?php
namespace App\Repositories\almacen\producto\proveedorProducto;
// Repositories
use App\Repositories\servicio\calculo\CalculoRepositories;
// Otros
use DB;

class StoreProveedorProductoRepositories implements StoreProveedorProductoInterface {
  protected $calculoRepo;
  public function __construct(CalculoRepositories $calculoRepositories) {
    $this->calculoRepo  = $calculoRepositories;
  }
  public function store($request, $producto) {
    DB::transaction(function() use($request, $producto) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
    $prec_clien = $this->calculoRepo->calcularUtilidad($request->precio_proveedor, $request->utilidad);
    
      $producto->proveedores()->attach($request->nombre_del_proveedor, [
        'prec_prove'      => $request->precio_proveedor,
        'utilid'          => $request->utilidad,
        'prec_clien'      => $prec_clien,
        'produc'          => $request->mombre_del_producto_que_maneja_el_proveedor,
        'cod_fabricante'  => $request->codigo_de_fabricante,
        'tip_iva'         => $request->iva,
        'ieps'            => $request->ieps
      ]);
      return $producto;
    });
  }
}