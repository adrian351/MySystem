<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\inventarioEquipos;
// Events
use App\Events\layouts\ArchivosEliminados;

class InventarioEquiposRepositories implements InventarioEquiposInterface {
  public function metodo($metodo, $consulta) {
    if($metodo == 'destroy') {
      $this->metDestroy($consulta);
    }
  }
  public function metDestroy($consulta) {
    // Elimina todas las imagenes relacionadas a este registro
    $archivos = null;
    $cont1 = 0;

    // ELIMINA TODAS LAS IMAGENES RELACIONADAS AL EQUIPO
    $imagenes = $consulta->archivos()->withTrashed()->get();
    foreach($imagenes as $imagen) {
      $archivos[$cont1] = $imagen->arc_nom;
      $cont1 +=1;
    }

    // ELIMINA TODAS LAS IMAGENES DEL HISTORIAL RELACIONADOS AL EQUIPO
    $historiales = $consulta->historiales()->with(['historialArchivos'=> function ($query) {
      $query->withTrashed()->get();
    }])->withTrashed()->get();

    foreach($historiales as $historial) {
      foreach($historial->historialArchivos as $archivo_hist) {
        $archivos[$cont1] = $archivo_hist->his_arch;
        $cont1 +=1;
      }
    }
  
    if($archivos != null) {
      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      ArchivosEliminados::dispatch(
        $archivos,
      );
    }
  }
}