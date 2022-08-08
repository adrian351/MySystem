<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PedidoArmadoTieneProducto;
use Faker\Generator as Faker;
use App\Models\Producto;
use App\Models\PedidoArmado;

$factory->define(PedidoArmadoTieneProducto::class, function (Faker $faker) {
  $id_armado  = $faker->randomElement(PedidoArmado::pluck('id'));
  $producto   = $faker->randomElement(Producto::all());
  return [
      'id_producto'       => $producto->id,
      'cant'              => '1',
      'produc'            => $producto->produc,
      'sku'               => $producto->sku,
      'pedido_armado_id'  => $id_armado,
  ];
});
