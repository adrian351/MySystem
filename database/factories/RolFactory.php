<?php
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Spatie\Permission\Models\Role::class, function (Faker $faker) {
    $usuario = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
    return [
        'nom'               => $faker->unique()->name,
        'name'              => $faker->unique()->name,
        'desc'              => $faker->paragraph,
        'asignado_rol'      => $usuario,
        'created_at_rol'    => $usuario
    ];
});