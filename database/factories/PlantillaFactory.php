<?php
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Models\Plantilla::class, function (Faker $faker) {
    $usuario = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
    return [
        'nom'               => $faker->unique()->name,
        'mod'				        => $faker->randomElement(config('opcionesSelect.select_modulo')),
        'asunt'             => 'Indefinido',
        'dis_de_la_plant'   => $faker->paragraph,
        'asignado_plan'     => $usuario,
        'created_at_plan'   => $usuario
    ];
});