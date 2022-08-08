<?php
namespace App\Repositories\almacen\producto\nota_remision;

interface NotaRemisionInterface {
  public function notaRemisionFindOrFailById($id_nota);
  
  public function store($request, $id_producto);

//   public function destroy($id_producto);
}