<?php
namespace App\Repositories\rolCliente\datoFiscal;

interface DatoFiscalInterface {
  public function getDatoFiscalFindOrFail($id_dato_fiscal, $relaciones);
  
  public function getPagination($request);

  public function store($request);

  public function storeFields($dato_fiscal, $request);

  public function update($request, $id_dato_fiscal);

  public function destroy($id_dato_fiscal);
  
  public function getAllDatosFiscalesClientePluck();

  public function getDatoFiscal($id_dato_fiscal);
}