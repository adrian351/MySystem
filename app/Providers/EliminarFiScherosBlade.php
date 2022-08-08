<?php

namespace App\Providers;

use App\Events\servicio\FicherosBladeEliminados;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EliminarFiScherosBlade
{
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
     * @param  FicherosBladeEliminados  $event
     * @return void
     */
    public function handle(FicherosBladeEliminados $event)
    {
        //
    }
}
