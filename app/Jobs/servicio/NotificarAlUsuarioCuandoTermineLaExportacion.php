<?php
namespace App\Jobs\servicio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\servicio\NotificacionAchivoGenerado;

class NotificarAlUsuarioCuandoTermineLaExportacion implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $usuario;
    public $archivo_generado;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($usuario, $archivo_generado) {
        $this->usuario = $usuario;
        $this->archivo_generado = $archivo_generado;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $this->usuario->notify(new NotificacionAchivoGenerado($this->archivo_generado));
    }
}