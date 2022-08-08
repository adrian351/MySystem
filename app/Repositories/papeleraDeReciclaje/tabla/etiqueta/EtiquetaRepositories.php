<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\etiqueta;
// Events
use App\Events\layouts\ArchivosEliminados;

class EtiquetaRepositories implements EtiquetaInterface {
  public function metodo($metodo, $consulta) {
    if($metodo == 'destroy') {
      $this->metDestroy($consulta);
    }
  }
  public function metDestroy($consulta) {
    ArchivosEliminados::dispatch(
        array([$consulta->etiqueta]), 
      );
    
  }
}