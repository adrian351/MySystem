<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Material;
use App\User;
use Faker\Generator as Faker;

$factory->define(Material::class, function (Faker $faker) {
    $usuario = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
    return [
        'sku'                   => $faker->ean13,
        'des'                   => $faker->paragraph,
        'lob'                   => $faker->cityPrefix,
        'produc_lin'            => $faker->secondaryAddress,
        'produc_lin_sub_gro'    => $faker->state,
        'fam_de_prod'           => $faker->stateAbbr,
        'lin_de_prod'           => $faker->citySuffix,
        'sub_lin_de_prod'       => $faker->streetSuffix,
        'prec_list_pag'         => $faker->randomFloat(2, 5, 20),
        'desc'                  => $faker->randomFloat(2, 5, 20),
        'prec_pag_al_cli'       => $faker->randomFloat(2, 5, 20),
        'asignado_mat'          => $usuario,
        'created_at_mat'        => $usuario,
    ];
});
