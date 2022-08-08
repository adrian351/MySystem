<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Models\Producto;
use App\Models\Catalogo;
use Faker\Generator as Faker;

$factory->define(Producto::class, function (Faker $faker) {
    $usuario    = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
    $prec_prove = $faker->randomFloat(3, 0, 1000);
    $utilid     = $faker->randomElement(['.1','.2','.3','.4']);
    $tip        = $faker->randomElement(config('opcionesSelect.select_tipo'));
    $tam        = null;
    $alto       = 0.00;
    $ancho      = 0.00;
    $largo      = 0.00;
    $cost_arm   = 0.00;
    if($tip == 'Canasta') {
        $produc     = 'Canasta ' . $faker->unique()->name;
        $tam        = $faker->randomElement(config('opcionesSelect.select_tamano'));
        $alto       = $faker->randomFloat(2, 1, 5);
        $ancho      = $faker->randomFloat(2, 1, 5);
        $largo      = $faker->randomFloat(2, 1, 5);
        $cost_arm   = $faker->randomFloat(2, 5, 20);
    } elseif($tip == 'Producto') {
        $produc = $faker->unique()->name;
    }
    $prec_prove_cost_arm = $cost_arm + $prec_prove;
    $prec_clien = $prec_prove_cost_arm / (1 - $utilid);
    return [
        'produc'            => $produc,
        'sku'               => 'PRO-' . $faker->unique()->numberBetween(111, 999999),
        'pro_de_cat'        => $faker->randomElement(config('opcionesSelect.select_producto_de_catalogo')),
        'marc'              => $faker->name,
        'tip'               => $tip,
        'tam'               => $tam,
        'alto'              => $alto,
        'ancho'             => $ancho,
        'largo'             => $largo,
        'cost_arm'          => $cost_arm,
        'cant_requerida'    => $faker->numberBetween(99, 999),
        'stock'             => $faker->numberBetween(9, 999),
        'prove'             => $faker->randomElement(\App\Models\Proveedor::pluck('nom_comerc')),
        'prec_prove'        => $prec_prove,
        'utilid'            => $utilid,
        'prec_clien'        => $prec_clien,
        'categ'             => $faker->randomElement(Catalogo::where('input', 'Productos (Categoría)')->pluck('value')),
        'etiq'              => $faker->randomElement(Catalogo::where('input', 'Productos (Etiqueta)')->pluck('value')),
        'pes'               => $faker->randomFloat(3, 1, 5),
        'cod_barras'        => $faker->ean13,
        'asignado_prod'  	  => $usuario,
        'created_at_prod'   => $usuario,
    ];
});
