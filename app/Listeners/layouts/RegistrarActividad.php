<?php
namespace App\Listeners\layouts;
use App\Events\layouts\ActividadRegistrada;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
//Models
use App\Models\Actividades;
// Otros
use Illuminate\Support\Facades\Auth;

class RegistrarActividad { // No implementar ShouldQueue
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
      //
  }

  /**
   * Handle the event.
   *
   * @param  ActividadRegistrada  $event
   * @return void
   */
  public function handle(ActividadRegistrada $event) {
    // Crea un arreglo bidimensional con la información de los campos que fueron modificados y los guarda con una sola consulta
    $camposBD = array('mod', 'rut', 'id_reg', 'reg', 'inpu', 'ant', 'nuev', 'user_id');
    $hastaC = count($event->campos) - 1;
    $datos = null;
    $contador3 = 0;
    for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
      if($event->modelo->isDirty($event->campos[$contador2])) {
        $datos[$contador2][$camposBD[$contador3]] = $event->modulo; // 'mod'
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $event->ruta; // 'rut'
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $event->id_registro; // 'id_reg'
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $event->registro; // 'reg'
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $event->inputs[$contador2]; // 'inpu'
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $event->modelo->getOriginal($event->campos[$contador2]); // 'ant'
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $event->modelo->getAttribute($event->campos[$contador2]); // 'nuev'
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = Auth::user()->id; // 'user_id'
        $contador3 = 0;
      }
    }
    Actividades::insert($datos);
  }
}