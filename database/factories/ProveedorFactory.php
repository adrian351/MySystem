<?php
use App\Models\Proveedor;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Proveedor::class, function (Faker $faker) {
    $usuario = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
    
    return [
        'raz_soc'           => $faker->unique()->safeEmail,
        'nom_comerc'        => $faker->unique()->catchPhrase,
        'fab_distri'        => $faker->randomElement(config('opcionesSelect.select_fabricante_distribuidor_index')),
        'rfc'               => $faker->name,
        'nom_rep_legal'     => $faker->name,
        'lad_mov'  			    => '55',
        'tel_mov'           => '56105713',
        'call'              => $faker->name,
        'no_ext'            => $faker->numberBetween(1,9999),
        'ciudad'            => $faker->name,
        'col'               => $faker->name,
        'del_o_munic'       => $faker->name,
        'cod_post'          => $faker->numberBetween(1, 999999),
        'asignado_prov'     => $usuario,
        'created_at_prov'   => $usuario
    ];
});
