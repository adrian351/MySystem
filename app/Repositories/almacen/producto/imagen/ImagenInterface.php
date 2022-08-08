<?php
namespace App\Repositories\almacen\producto\imagen;

interface ImagenInterface {
  public function imagenFindOrFailById($id_imagen, $relaciones);
  
  public function store($request, $id_producto);

  public function destroy($id_producto);
}