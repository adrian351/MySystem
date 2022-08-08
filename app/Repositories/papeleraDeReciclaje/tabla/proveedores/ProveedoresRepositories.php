<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\proveedores;
// Events
use App\Events\layouts\ArchivosEliminados;

class ProveedoresRepositories implements ProveedoresInterface {
  public function metodo($metodo, $consulta) {
    if($metodo == 'destroy') {
      $this->metDestroy($consulta);
    }
  }
  public function metDestroy($consulta) {
    // Dispara el evento registrado en App\Providers\EventServiceProvider.php
    ArchivosEliminados::dispatch(
      array($consulta->arch_nom), 
    );
  }
}