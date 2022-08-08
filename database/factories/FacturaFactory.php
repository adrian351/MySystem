<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Models\Pago;
use App\Models\Factura;
use Faker\Generator as Faker;

$factory->define(Factura::class, function (Faker $faker) {
    $cliente    = $faker->randomElement(User::where('acceso', '2')->get());
    $id_pago       = $faker->unique()->randomElement(Pago::pluck('id'));
    return [
        'nom_o_raz_soc'     => $faker->name,
        'rfc'               => $faker->numberBetween(1, 9999),
        'lad_mov'           => $faker->numberBetween(1, 9999),
        'tel_mov'           => $faker->numberBetween(11111111, 999999999999),
        'lad_fij'           => $faker->numberBetween(1, 9999),
        'tel_fij'           => $faker->numberBetween(11111111, 999999999999),
        'calle'             => $faker->name,
        'no_ext'            => $faker->numberBetween(1, 9999),
        'pais'  			      => $faker->name,
        'ciudad'     	      => $faker->name,
        'col'               => $faker->name,
        'del_o_munic'       => $faker->name,
        'cod_post'          => $faker->numberBetween(1, 9999),
        'corr'              => $faker->safeEmail,
        'uso_de_cfdi'       => $faker->randomElement(config('opcionesSelect.select_uso_de_cfdi')),
        'met_de_pag'        => $faker->randomElement(config('opcionesSelect.select_metodo_de_pago')),
        'form_de_pag'       => $faker->randomElement(config('opcionesSelect.select_forma_de_pago_factura')),
        'concept'           => $faker->randomElement(config('opcionesSelect.select_concepto')),
    //    'mont_a_fact'       => $pago->mont_de_pag,
        'pago_id'           => $id_pago,
        'user_id'           => $cliente->id,
        'created_at_fact'   => $cliente->email_registro,
    ];
});


