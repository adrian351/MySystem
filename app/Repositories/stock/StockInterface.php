<?php
namespace App\Repositories\stock;

interface StockInterface {
  public function stockFindOrFailById($id_stock, $relaciones);

  public function getPagination($request);

  public function store($request);

  public function update($request, $id_stock);

  Public function destroy($id_stock);
}