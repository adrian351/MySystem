<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Models\Armado;
use Faker\Generator as Faker;

$factory->define(Armado::class, function (Faker $faker) {
    $usuario = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
    return [
        'clon'              => $faker->randomElement(array('0', '1')),
        'num_clon'          => $faker->numberBetween(1, 9),
        'sku'               => 'ARC-' . $faker->unique()->numberBetween(999, 999999),
        'tip'               => $faker->randomElement(config('opcionesSelect.select_tipo')),
        'nom'               => $faker->unique()->name,
        'gama'              => $faker->randomElement(['Premium', 'Económica', 'Intermedia', 'Ejecutiva', 'Empresarial', 'Express']),
        'dest'              => $faker->randomElement(config('opcionesSelect.select_destacado')),
        'obs'               => $faker->text,
        'created_at_arm'    => $usuario,
        'asignado_arm'      => $usuario,
    ];
});