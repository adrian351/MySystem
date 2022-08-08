<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Models\Manual;
use Faker\Generator as Faker;

$factory->define(Manual::class, function (Faker $faker) {
  $usuario = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
    return [
        'usu_cli_ambos'   => $faker->randomElement(config('opcionesSelect.select_usu_cli_ambos')),
        'valor'           => $faker->name,
        'rut'             => env('PREFIX'),
        'nom'             => 'manuales/'.$faker->name,
        'rut_edit'        => env('PREFIX'),
        'nom_edit'        => 'manuales/'.$faker->name,
        'created_at_reg'  => $usuario,
        'updated_at_reg'  => $usuario,
    ];
});
