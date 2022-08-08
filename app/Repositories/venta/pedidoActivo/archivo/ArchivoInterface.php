<?php
namespace App\Repositories\venta\pedidoActivo\archivo;

interface ArchivoInterface {
  public function archivoFindOrFailById($id_archivo);

  public function store($request, $id_pedido);

  Public function destroy($id_archivo);
}