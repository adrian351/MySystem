<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Soporte;
use App\Model\SoporteArchivo;
use App\Models\SoporteArchivo as ModelsSoporteArchivo;
use Faker\Generator as Faker;

$factory->define(ModelsSoporteArchivo::class, function (Faker $faker) {
    $soporte_id = $faker->randomElement(\App\Models\Soporte::all()->pluck('id'));
    return [
        'arc_rut'        =>     $faker->text,
        'arc_nom'        =>     $faker->text,
        'soporte_id'     =>     $soporte_id,        
    ];
});
