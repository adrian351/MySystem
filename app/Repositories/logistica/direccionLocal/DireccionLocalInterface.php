<?php
namespace App\Repositories\logistica\direccionLocal;

interface DireccionLocalInterface {
  public function direccionLocalFindOrFailById($id_direccion, $for_loc, $relaciones, $accion, $regresado);
  
  public function getPagination($request, $for_loc, $relaciones);
  
  public function store($request, $id_direccion);

  public function storeEntrega($request, $id_direccion);

  public function update($request, $id_direccion, $loc_for);
  
  public function cambiarEstatusDireccionAlmacenDeSalida($direcciones);
}