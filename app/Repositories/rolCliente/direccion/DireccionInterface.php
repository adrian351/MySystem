<?php
namespace App\Repositories\rolCliente\direccion;

interface DireccionInterface {
  public function getDireccionFindOrFail($id_direccion, $relaciones);

  public function getPagination($request);

  public function store($request);

  public function storeFields($direccion, $request);

  public function update($request, $id_direccion);

  public function destroy($id_direccion);

  public function getDireccionesClientePluck();

  public function getDireccionFind($id_direccion);

  public function getDireccion($id_direccion);
}