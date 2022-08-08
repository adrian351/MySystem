<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cotizacion;
use Faker\Generator as Faker;
use App\User;
use App\Models\Serie;

$factory->define(Cotizacion::class, function (Faker $faker) {
    $usuario    = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
    $id_cliente = $faker->randomElement(User::where('acceso', '2')->pluck('id'));
    $serie      = $faker->unique()->randomElement(Serie::where('input', 'Cotizaciones (Serie)')->pluck('value'));
    return [
        'ser'               => $serie,
        'serie'             => $serie,
        'valid'             => date("Y-m-d", strtotime('+20 day', strtotime(date("Y-m-d")))),
        'desc_cot'          => $faker->paragraph,
        'asignado_cot'      => $usuario,
        'created_at_cot'    => $usuario,
        'user_id'           => $id_cliente,
    ];
});
