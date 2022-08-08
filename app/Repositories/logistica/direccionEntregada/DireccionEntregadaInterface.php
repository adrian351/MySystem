<?php
namespace App\Repositories\logistica\direccionEntregada;

interface DireccionEntregadaInterface {
  public function direccionEntregadaFindOrFailById($id_direccion, $relaciones);
  
  public function getPagination($request, $relaciones);
}