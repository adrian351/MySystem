<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\productos\imagen;
// Events
use App\Events\layouts\ArchivosEliminados;

class ImagenRepositories implements ImagenInterface {
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