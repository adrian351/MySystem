<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\productos;
// Events
use App\Events\layouts\ArchivosEliminados;

class ProductosRepositories implements ProductosInterface {
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
    if($consulta->img_prod_nom != null) { 
      array_push($imagenes, $consulta->img_prod_nom); // Agrega la imagen asignada al armado para tambien eliminarla
    }
    // Dispara el evento registrado en App\Providers\EventServiceProvider.php
    ArchivosEliminados::dispatch(
      $imagenes, 
    );
  }
}