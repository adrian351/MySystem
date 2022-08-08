<?php
namespace App\Repositories\tecnologiaDeLainformacion\soporte;

interface SoporteInterface {
  public function soporteFindOrFailById($id_soporte, $relaciones);

  public function getPagination($request);
  
  public function store($request);

  public function update($request, $id_soporte);
  
  public function destroy($id_soporte);

  public function actualizarSoporte($request, $soporte);

  public function agregarSoporteaHistorial($request, $soporte);
}