<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\InventarioEquipo;
use Faker\Generator as Faker;

$factory->define(InventarioEquipo::class, function (Faker $faker) {
    return [
        'id_equipo'             => $faker->unique()->numberBetween($min = 1000, $max = 9000),
        'ult_fec_de_man'        => $faker->dateTime($max = 'now', $timezone = null),
        'prox_fec_de_man'       => $faker->dateTime($max = 'now', $timezone = null),
        'emp'                   => $faker->name,
        'resp'                  => $faker->name,
        'des_del_equ'           => $faker->text,
        'num_ser'               => $faker->numberBetween($min = 1000, $max = 9000),
        'mar'                   => $faker->name,
        'mod'                   => $faker->name,
        'asignado_inv_equ'      => $faker->email,
        'created_at_inv_equ'    => $faker->email,
        'updated_at_inv_equ'    => $faker->email,
    ];
});
