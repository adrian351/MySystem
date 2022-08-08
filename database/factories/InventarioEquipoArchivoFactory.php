<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\InventarioEquipo;
use App\Models\InventarioEquipoArchivo as ModelInventarioEquipoArchivo;
use Faker\Generator as Faker;

$factory->define(ModelInventarioEquipoArchivo::class, function (Faker $faker) {
    $inventario_id = $faker->randomElement(InventarioEquipo::pluck('id'));
    return [
        'arc_rut'               => $faker->text,
        'arc_nom'               => $faker->text,
        'inventario_equipo_id'  => $inventario_id,    
    ];
});
