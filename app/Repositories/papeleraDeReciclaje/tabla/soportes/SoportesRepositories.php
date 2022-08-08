<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\soportes;
// Events
use App\Events\layouts\ArchivosEliminados;

class SoportesRepositories implements SoportesInterface {
  public function metodo($metodo, $consulta) {
    if($metodo == 'destroy') {
      $this->metDestroy($consulta);
    }
  }
  public function metDestroy($consulta) {
    // Elimina todas las imagenes relacionadas a este registro
    $archivos_soporte = $consulta->archivos()->withTrashed()->get();

    $hastaC = count($archivos_soporte) - 1;
    $archivos = [];
    for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
      $archivos[$contador2] = $archivos_soporte[$contador2]->arc_nom;
    }
  
    // Dispara el evento registrado en App\Providers\EventServiceProvider.php
    ArchivosEliminados::dispatch(
      $archivos,
    );
  }
}