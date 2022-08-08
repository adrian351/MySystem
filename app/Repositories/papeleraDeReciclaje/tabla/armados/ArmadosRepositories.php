<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\armados;
// Events
use App\Events\layouts\ArchivosEliminados;

class ArmadosRepositories implements ArmadosInterface {
  public function metodo($metodo, $consulta) {
    if($metodo == 'destroy') {
      $this->metDestroy($consulta);
    }
  }
  public function metDestroy($consulta) {
    // Elimina todas las imagenes relacionadas a este registro
    $hastaC = count($consulta->imagenes) - 1;
    $imagenes = [];
    for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
      $imagenes[$contador2] = $consulta->imagenes[$contador2]->img_nom;
    }
    if($consulta->img_nom != null) { 
      array_push($imagenes, $consulta->img_nom); // Agrega la imagen asignada al armado para tambien eliminarla
      array_push($imagenes, $consulta->img_nom_min); // Agrega la imagen asignada al armado para tambien eliminarla
    }
    // Dispara el evento registrado en App\Providers\EventServiceProvider.php
    ArchivosEliminados::dispatch(
      $imagenes, 
    );
  }
}