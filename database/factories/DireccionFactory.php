<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Models\Direccion;
use Faker\Generator as Faker;

$factory->define(Direccion::class, function (Faker $faker) {
    $cliente = $faker->randomElement(User::where('acceso', '2')->get());
    return [
        'nom_ref_uno'       => $faker->name,
        'lad_mov'           => $faker->numberBetween(1, 9999),
        'tel_mov'           => $faker->numberBetween(11111111, 999999999999),
        'lad_fij'           => $faker->numberBetween(1, 9999),
        'tel_fij'           => $faker->numberBetween(11111111, 999999999999),
        'calle'             => $faker->name,
        'no_ext'            => $faker->numberBetween(1, 9999),
        'pais' 			        => $faker->name,
        'ciudad' 	          => $faker->name,
        'col'               => $faker->name,
        'del_o_munic'       => $faker->name,
        'cod_post'          => $faker->numberBetween(1, 9999),
        'user_id'           => $cliente->id,
        'created_at_direc'  => $cliente->email_registro,
    ];
});
