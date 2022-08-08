<?php
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    $correo = $faker->unique()->safeEmail;
    $opc_sidebar = array(null, 'sidebar-collapse');
    $opc_lang = array('es', 'en');
    $usuario = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
    return [
        'acceso'                    => $faker->randomElement(['1', '2', '3']),
        'nom' 				              => $faker->name,
        'apell' 			              => $faker->lastName,
        'email_registro'            => $correo,
        'email' 			              => $correo,
        'email_secund'              => $faker->safeEmail,
        'lad_mov'                   => $faker->numberBetween(1, 9999),
        'tel_mov'                   => $faker->numberBetween(11111111, 999999999999),
        'lad_fij'                   => $faker->numberBetween(1, 9999),
        'tel_fij'                   => $faker->numberBetween(11111111, 999999999999),
        'ext'                       => $faker->numberBetween(1, 99999),
        'emp'                       => $faker->title,
        'email_verified_at'         => NULL,
        'password' 			            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' 	          => Str::random(10),
        'obs'                       => $faker->paragraph,
        'lang'                      => $faker->randomElement($opc_lang),
        'sidebar'                   => $faker->randomElement($opc_sidebar),
        'col_barr_de_naveg'         => $faker->randomElement(config('opcionesSelect.select_color_barra_de_navegacion')),
        'col_barr_lat_oscu_o_clar'  => $faker->randomElement(config('opcionesSelect.select_color_barra_lateral_oscura_o_clara')),
        'col_logot'                 => $faker->randomElement(config('opcionesSelect.select_color_logotipo')),
        'asignado_us'  	            => $usuario,
        'created_at_us'             => $usuario,
    ];
});