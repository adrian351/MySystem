<?php
namespace App\Listeners\layouts;
use App\Events\layouts\ArchivosEliminados;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
// Otros
use Storage;

class EliminarArchivo implements ShouldQueue {
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct() {
      //
  }

  /**
   * Handle the event.
   *
   * @param  ArchivosEliminados  $event
   * @return void
   */
  public function handle(ArchivosEliminados $event) {
    // Elimina los archivos que recibe la funcion y los elimina del servidor
    $hasta = count($event->ruta_nombre) - 1;
    for($contador1 = 0; $contador1 <= $hasta; $contador1++) {
      Storage::disk('s3')->delete($event->ruta_nombre[$contador1]);
      //    Storage::delete([$event->ruta_nombre[$contador1]]);
    }
  }
}