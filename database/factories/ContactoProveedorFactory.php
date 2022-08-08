<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ContactoProveedor;
use Faker\Generator as Faker;
use App\User;

$factory->define(ContactoProveedor::class, function (Faker $faker) {
    $usuario = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
    $proveedor_id = $faker->randomElement(\App\Models\Proveedor::pluck('id'));

    return [
        'nom'                   => $faker->safeEmail,
        'carg'                  => $faker->name,
        'lad_mov'  			        => '55',
        'tel_mov'               => '56105713',
        'proveedor_id'          => $proveedor_id, // El 100 depende de cuandos proveedores se crearan
        'created_at_prov_cont'  => $usuario
    ];
});
