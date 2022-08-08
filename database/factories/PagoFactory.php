<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Models\Pedido;
use App\Models\Pago;
use Faker\Generator as Faker;

$factory->define(Pago::class, function (Faker $faker) {
    $pedido = $faker->randomElement(Pedido::get());
    $usuario = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
    return [
      'cod_fact'              => $faker->unique()->numberBetween(999, 99999999999),
      'fol'                   => $faker->unique()->numberBetween(11111, 99999),
      'comp_de_pag_rut'       => 'public/perfil/2020-02/',
      'comp_de_pag_nom'       => 'perfil-1582071257.png',
      'mont_de_pag'           => $faker->numberBetween(1, 999),
      'form_de_pag'           => $faker->randomElement(config('opcionesSelect.select_forma_de_pago')),
      'pedido_id'             => $pedido->id,
      'user_id'               => $pedido->user_id,
      'created_at_pag'        => $usuario,
    ];
});
