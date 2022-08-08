<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\QuejaYSugerencia;
use App\Models\QuejaYSugerenciaArchivo;
use Faker\Generator as Faker;

$factory->define(QuejaYSugerenciaArchivo::class, function (Faker $faker) {
    $id_qys = $faker->randomElement(QuejaYSugerencia::pluck('id'));
    return [
        'arch_rut'              => 'public/perfil/2020-02/',
        'arch_nom'              => 'perfil-1582071257.png',
        'queja_y_sugerencia_id' => $id_qys,
    ];
});