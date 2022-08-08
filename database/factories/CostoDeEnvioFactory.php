<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CostoDeEnvio;
use Faker\Generator as Faker;
use App\User;
use App\Models\Estado;
use App\Models\MetodoDeEntrega;
use App\Models\TipoDeEnvio;
// nom_met_ent
$factory->define(CostoDeEnvio::class, function (Faker $faker) {
  $randomDigit    = $faker->randomDigit();
  $reg            = $faker->randomElement(config('opcionesSelect.select_si_no'));
  $tam            = $faker->randomElement(config('opcionesSelect.select_tamano'));
  $tiemp_ent      = 'De '.$randomDigit.' a '.($randomDigit+2).' dias';
  $met_de_entreg  = $faker->randomElement(MetodoDeEntrega::pluck('nom_met_ent'));
  $est            = $faker->randomElement(Estado::pluck('est'));
  $for_loc        = $faker->randomElement(config('opcionesSelect.select_foraneo_local'));
  $tip_env        = $faker->randomElement(TipoDeEnvio::pluck('tip_de_env'));
  $cost_por_env   = $faker->randomFloat(2, 5, 20);
  $registr        = strtolower(trim($reg.$tam.$tiemp_ent));
  $usuario        = $faker->randomElement(User::where('acceso', '1')->pluck('email_registro'));
 
  return [
    'seg'             => $reg,
    'tam'             => $tam,
    'tiemp_ent'       => $tiemp_ent,
    'met_de_entreg'   => $met_de_entreg,
    'est'             => $est,
    'for_loc'         => $for_loc,
    'tip_env'         => $tip_env,
    'cost_por_env'    => $cost_por_env,
    'registr'         => $registr,
    'asignado_env'    => $usuario,
    'created_at_env'  => $usuario,
  ];
});