<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Models\Pedido;
use App\Models\Armado;
use App\Models\PedidoArmado;
use Faker\Generator as Faker;

$factory->define(PedidoArmado::class, function (Faker $faker) {
    $armado = $faker->randomElement(Armado::all());
    $pedido = $faker->randomElement(Pedido::all());
    $usuario = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
    return [
        'cod'                   => $pedido->num_pedido.'-'.$faker->stateAbbr,
        'estat'                 => $faker->randomElement([config('app.en_espera_de_compra'), config('app.en_revision_de_productos'), config('app.productos_completos'), config('app.en_produccion'), config('app.en_almacen_de_salida'), config('app.en_ruta'), config('app.entregado'), config('app.sin_entrega_por_falta_de_informacion'), config('app.intento_de_entrega_fallido')]),
        'cant'                  => '100',
        'for_loc'               => $faker->randomElement(['Foráneo', 'Local']),
        'tip'                   => $armado->tip,
        'nom'                   => $armado->nom,
        'sku'                   => $armado->sku,
        'gama'                  => $armado->gama,
        'prec'                  => $armado->prec_redond,
        'tam'                   => $faker->randomElement(config('opcionesSelect.select_tamano')),
        'pes'                   => $armado->pes,
        'alto'                  => $armado->alto,
        'ancho'                 => $armado->ancho,
        'largo'                 => $armado->largo,
        'pedido_id'             => $pedido->id,
        'created_at_ped_arm'    => $usuario,
    ];
});