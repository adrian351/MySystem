<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\manual;
// Events
use App\Events\layouts\ArchivosEliminados;

class ManualRepositories implements ManualInterface {
  public function metodo($metodo, $consulta) {
    if($metodo == 'destroy') {
      $this->metDestroy($consulta);
    }
  }
  public function metDestroy($consulta) {
    // Dispara el evento registrado en App\Providers\EventServiceProvider.php
    ArchivosEliminados::dispatch(
      array([$consulta->nom, $consulta->nom_edit]), 
    );
  }
}