<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Historial;
use App\Models\HistorialArchivo;
use Faker\Generator as Faker;

$factory->define(HistorialArchivo::class, function (Faker $faker) {
    $historial_id = $faker->randomElement(Historial::pluck('id'));
    return [
        'his_arch_rut'      =>  $faker->text,
        'his_arch'          =>  $faker->text,
        'historial_id'      =>  $historial_id,
    ];
});
