<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\inventarioEquipos;
// Events
use App\Events\layouts\ArchivosEliminados;

class InventarioEquiposImagenesRepositories implements InventarioEquiposImagenesInteface {
  public function metodo($metodo, $consulta) {
    if($metodo == 'destroy') {
      $this->metDestroy($consulta);
    }
  }
  public function metDestroy($consulta) {
    // Dispara el evento registrado en App\Providers\EventServiceProvider.php
    ArchivosEliminados::dispatch(
        array($consulta->arc_nom), 
      );
  }
}