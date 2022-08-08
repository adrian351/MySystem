<?php
namespace App\Events\layouts;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArchivosEliminados {
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $ruta_nombre;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ruta_nombre) {
        $this->ruta_nombre = $ruta_nombre;
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
