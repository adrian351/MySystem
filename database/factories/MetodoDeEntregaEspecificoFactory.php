<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MetodoDeEntregaEspecifico;
use App\Models\MetodoDeEntrega;
use App\User;
use Faker\Generator as Faker;

$factory->define(MetodoDeEntregaEspecifico::class, function (Faker $faker) {
  $usuario = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
  $metodo_de_entrega = $faker->randomElement(MetodoDeEntrega::pluck('id'));
  return [
    'nom_met_ent_esp'       => $faker->company(),
    'url'                   => $faker->url(),
    'metodo_de_entrega_id'  => $metodo_de_entrega,
    'created_at_met_ent'    => $usuario
  ];
});
