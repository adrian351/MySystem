<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\cotizaciones;
// Events
use App\Events\layouts\ArchivosEliminados;

class CotizacionesRepositories implements CotizacionesInterface {
  public function metodo($metodo, $consulta) {
    if($metodo == 'destroy') {
      $this->metDestroy($consulta);
    }
  }
  public function metDestroy($consulta) {
    $contador = 0;
    $imagenes = null;
    $armados = $consulta->armados()->withTrashed()->get(['id', 'img_rut', 'img_nom', 'cotizacion_id']);

    foreach($armados as $armado) {
      if($armado->img_nom != null) {
        $imagenes[$contador] = $armado->img_nom;
        $contador++;
      }
    }
    if($imagenes != null) {
      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      ArchivosEliminados::dispatch($imagenes);
    }
  }
}