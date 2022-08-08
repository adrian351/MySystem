<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\usuarios;
// Events
use App\Events\layouts\ArchivosEliminados;

class UsuariosRepositories implements UsuariosInterface {
  public function metodo($metodo, $consulta) {
    if($metodo == 'destroy') {
      $this->metDestroy($consulta);
    }
  }
  public function metDestroy($consulta) {
    // Dispara el evento registrado en App\Providers\EventServiceProvider.php
    ArchivosEliminados::dispatch(
      array($consulta->img_us), 
    );
  }
}