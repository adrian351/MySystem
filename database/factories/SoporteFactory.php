<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Soporte;
use Faker\Generator as Faker;

$factory->define(Soporte::class, function (Faker $faker) {
    return [
        'emp'                  => $faker->name,
        'sol'                  => $faker->name,
        'area_dep'             => $faker->name,
        'des_de_la_falla'      => $faker->text,
        'solu'                 => $faker->text,
        'obs_del_equipo'       => $faker->text,
    ];
});
