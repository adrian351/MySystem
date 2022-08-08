<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Serie;
use App\User;
use Faker\Generator as Faker;

$factory->define(Serie::class, function (Faker $faker) {
    $p1             = $faker->streetSuffix;
    $p2             = $faker->tld;
    $value_vista    = $p1.$p2;
    $usuario        = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
    return [
        'input'             => $faker->randomElement(config('opcionesSelect.select_input_serie')),
        'value'             => $value_vista . '-',
        'vista'             => $value_vista . '-',
        'asignado_ser'      => $usuario,
        'created_at_ser'    => $usuario
    ];
});