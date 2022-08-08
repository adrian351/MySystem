<?php
namespace App\Repositories\proveedor\contacto_proveedor;

interface ContactoInterface {
  public function contactoFindOrFailById($id_contacto);

  public function store($request, $id_proveedor);

  public function update($request, $id_contacto);

  public function destroy($id_contacto);
}