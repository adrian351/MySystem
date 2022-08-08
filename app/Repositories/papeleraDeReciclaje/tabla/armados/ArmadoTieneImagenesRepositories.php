<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\armados;
// Events
use App\Events\layouts\ArchivosEliminados;

class ArmadoTieneImagenesRepositories implements ArmadoTieneImagenesInteface {
  public function metodo($metodo, $consulta) {
    if($metodo == 'destroy') {
      $this->metDestroy($consulta);
    }
  }
  public function metDestroy($consulta) {
    // Dispara el evento registrado en App\Providers\EventServiceProvider.php
    ArchivosEliminados::dispatch(
      array($consulta->img_nom), 
    );
  }
}