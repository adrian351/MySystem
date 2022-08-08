<?php
namespace App\Events\layouts;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ActividadRegistrada {
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $modulo, $ruta, $id_registro, $registro, $inputs, $modelo, $campos;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($modulo, $ruta, $id_registro, $registro, $inputs, $modelo, $campos) {
        $this->modulo       = $modulo;
        $this->ruta         = $ruta;
        $this->id_registro  = $id_registro;
        $this->registro     = $registro;
        $this->inputs       = $inputs;
        $this->modelo       = $modelo;
        $this->campos       = $campos;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
