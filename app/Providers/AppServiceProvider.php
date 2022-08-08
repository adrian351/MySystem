<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Validator;

class AppServiceProvider extends ServiceProvider {
  public function register() {
    //
  }
  public function boot() {
    // REDIRECCION A HTTPS SI EL SISTEMA ESTA EN PRODUCCIÓN
    if(config('app.env') === 'production') {
      \URL::forceScheme('https');
    }

    Schema::defaultStringLength(120); // Longitud maxima de los campos en la base de datos esto es al generar las migraciones
    Validator::extend('alpha_solo_espacios_letras_punto', function ($attribute, $value) { // Validación
        return preg_match('/^[\pL\s\.]+$/u', $value); 
    });
    Validator::extend('alpha_solo_puntos_y_letras', function ($attribute, $value) { // Validación
        return preg_match('/^([a-z\.]{0,61})?$/', $value); 
    });
    Validator::extend('alpha_solo_numeros', function ($attribute, $value) { // Validación
        return preg_match('/^([0-9]{0,50})?$/', $value); 
    });
    Validator::extend('alpha_solo_numeros_guiones', function ($attribute, $value) { // Validación
        return preg_match('/^([0-9\-]{0,50})?$/', $value); 
    });
    Validator::extend('alpha_decimal15', function ($attribute, $value) { // Validación
        return preg_match('/^([0-9\.]{0,15})?$/', $value); 
    });
    Validator::extend('alpha_decimal18', function ($attribute, $value) { // Validación
        return preg_match('/^([0-9\.]{0,18})?$/', $value); 
    });
    Validator::extend('alpha_decimal7', function ($attribute, $value) { // Validación
        return preg_match('/^([0-9\.]{0,7})?$/', $value); 
    });
    Validator::extend('alpha_cierre_fiscal', function ($attribute, $value) { // Validación
      $year_actual = date("Y");
      $mes_limite = '12';
      $dia_limite = '30';

      $pago = \App\Models\Pago::where('cod_fact', $value)->first(['created_at', 'id']);
      if($pago == null) {
        return false;
      }
     
      if($pago->created_at->format('Y') != $year_actual) {
        return false;
      }

      if(date("m") == $mes_limite) {
        if(date("d") > $dia_limite) {
          return false;
        }
      }

/*
      if($pago->created_at->format('m') <= $mes_limite) {
        if($pago->created_at->format('d') > $dia_limite) {
          return false;
        }
      }
*/
      return true; 
    });
    Validator::extend('alpha_unique_where', function ($attribute, $value, $otros) { // Validación
        $tabla  = $otros['0'];
        $inpu   = $otros['1'];
        if(isset($otros['2'])                 ){
            $consul     = 'AND id <>' . $otros['2'];
        } else {
            $consul     = null;
        }
        $resultado = \DB::SELECT("SELECT * FROM $tabla WHERE $attribute = '$value' AND input = '$inpu' $consul");
        if(sizeof($resultado)) {
            return false;
        }
        return true; 
    });
    Validator::extend('alpha_codigo_de_facturacion_pertenece_al_usuario', function ($attribute, $value, $user_id) { // Validación
      $resultado = \App\Models\Pago::where('cod_fact', $value)->first('user_id');
      if($resultado == null) {
        return false;
      }
      if($resultado->user_id != $user_id[0]) {
        return false;
      }
      return true; 
    });
    Validator::extend('alpha_estatus_codigo_de_facturacion', function ($attribute, $value) { // Validación
      $resultado = \App\Models\Pago::where('cod_fact', $value)->first('est_fact');

      if($resultado == null) {
        return false;
      }
      if($resultado->est_fact != config('app.no_solicitada') AND $resultado->est_fact != config('app.cancelado')) {
        return false;
      }
      return true; 
    });
    Validator::extend('alpha_solo_facturar_si_ya_esta_pagado', function ($attribute, $value) { // Validación
      $resultado = \App\Models\Pago::where('cod_fact', $value)->first(['estat_pag','not']);

      if($resultado == null) {
        return false;
      }

      if($resultado->estat_pag != config('app.aprobado')) {
        if($resultado->not != null) {
          return true;
        }
        return false;
      }

      return true; 
    });
    Validator::extend('alpha_con_o_sin_iva', function ($attribute, $value) { // Validación     
      $resultado = \App\Models\Pago::where('cod_fact', $value)->with(['pedido'=> function ($query) {
        $query->select('id', 'con_iva');
      }])->first(['id', 'pedido_id']);
      if($resultado == null) {
        return false;
      }
      if($resultado->pedido->con_iva == null) {
        return false;
      }
      return true; 
    });
    Validator::extend('alpha_total_armado', function ($attribute, $value, $id) { // Validación  
      $resultado = \App\Models\Armado::with('productos')->where('id', $id[0])->first();
      $precio_original = 0;

      foreach($resultado->productos as $producto) {
        $precio_original += $producto->prec_clien * $producto->pivot->cant;
      }

      if($value >= $precio_original) {
        return false;
      }
      return true; 
    });
  }
}