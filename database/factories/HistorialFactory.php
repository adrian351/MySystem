<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\InventarioEquipo;
use App\Models\Historial;
use Faker\Generator as Faker;

$factory->define(Historial::class, function (Faker $faker) {
    $inventario_equipo_id = $faker->randomElement(InventarioEquipo::pluck('id'));

    return [
        'fec_sol_sop'            => $faker->dateTime($max = 'now', $timezone = null),
        'fec_ent'                => $faker->dateTime($max = 'now', $timezone = null),
        'sol'                    => $faker->name,
        'area_dep'               => $faker->name,
        'tec'                    => $faker->name,
        'grup_de_falla'          => $faker->name,
        'des_de_la_falla'        => $faker->text,
        'solu'                   => $faker->text,
        'obs_del_equipo'         => $faker->text,
        'inventario_equipo_id'   => $inventario_equipo_id,
    ];
});
