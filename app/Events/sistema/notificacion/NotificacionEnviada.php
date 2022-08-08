<?php

namespace App\Events\sistema\notificacion;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificacionEnviada
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $notificacion, $usuarios, $remitente, $plantilla;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($notificacion, $usuarios, $remitente) {
        $this->notificacion = $notificacion;
        $this->usuarios     = $usuarios;
        $this->remitente    = $remitente;
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
