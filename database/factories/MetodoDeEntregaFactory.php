<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MetodoDeEntrega;
use App\User;
use Faker\Generator as Faker;

$factory->define(MetodoDeEntrega::class, function (Faker $faker) {
  $usuario = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
  return [
    'nom_met_ent'         => $faker->unique()->secondaryAddress(),
    'for_loc'             => $faker->randomElement(config('opcionesSelect.select_foraneo_local')),
    'asignado_met_ent'    => $usuario,
    'created_at_met_ent'  => $usuario
  ];
});
