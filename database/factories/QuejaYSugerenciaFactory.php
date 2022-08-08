<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\QuejaYSugerencia;
use App\User;
use Faker\Generator as Faker;

$factory->define(QuejaYSugerencia::class, function (Faker $faker) {
  $id_usuario = $faker->randomElement(User::pluck('id'));
    return [
        'tip'       => $faker->randomElement(config('opcionesSelect.select_queja_o_sugerencia')),
        'depto'     => $faker->randomElement(config('opcionesSelect.select_departamento')),
        'obs'       => 'Pesimo servicio',
        'user_id'   => $id_usuario,
    ];
});
