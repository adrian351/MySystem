<?php
namespace App\Http\Requests\armado\clonArmado;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class UpdateClonArmadoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_armado = Crypt::decrypt($this->id_armado);
    return [
      'tipo'                => 'required|exists:catalogos,value',
      'nombre'              => 'required|max:87|unique:armados,nom,' . $id_armado,
      // 'sku'                 => 'nullable|max:57|unique:armados, sku' . $id_armado,
      // 'gama'                => 'nullable|max:150|exists:catalogos,value',
      // 'destacado'           => 'nullable|in:Si,No',
      'imagen_del_armado'   => 'nullable|max:1024|image',
      'url_pagina'          => 'max:150',
      'observaciones'       => 'nullable|max:30000|string',
    ];
  }
}