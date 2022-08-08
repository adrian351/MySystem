<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Catalogo;
use App\User;
use Faker\Generator as Faker;

$factory->define(Catalogo::class, function (Faker $faker) {
    $value_vista    = $faker->jobTitle;
    $usuario = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
    return [
        'input'             => $faker->randomElement(config('opcionesSelect.select_input')),
        'value'             => $value_vista,
        'vista'             => $value_vista,
        'asignado_cat'      => $usuario,
        'created_at_cat'    => $usuario
    ];
});