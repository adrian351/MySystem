<?php
namespace App\Http\Requests\armado;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class UpdateArmadoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_armado = Crypt::decrypt($this->id_armado);
    return [
      'tipo'                => 'required|max:150|exists:catalogos,value',
      'nombre'              => 'required|max:60|unique:armados,nom,' . $id_armado,
      'sku'                 => 'nullable|unique:armados,sku,' . $id_armado,
      // 'skuArmado'           => 'max:30|unique:armados,skuArmado' .$id_armado,
      // 'armado_de_catalogo'          => 'required|in:Si,No',
      // 'gama'                => 'required|max:150|exists:catalogos,value',
      'stock_armado'        => 'nullable|numeric|min:0|required_if:operacion,sumar,restar',
      'operacion'           => 'nullable|in:sumar,restar',
      'destacado'           => 'required|in:Si,No',
      'imagen_del_armado'   => 'nullable|max:1024|image',
      'url_pagina'          => 'max:150',
     // 'descuento_especial'  => 'required|numeric|alpha_decimal15|alpha_total_armado:' . $id_armado,
      'observaciones'       => 'nullable|max:30000|string',
    ];
  }
}