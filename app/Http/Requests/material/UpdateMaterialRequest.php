<?php
namespace App\Http\Requests\material;
use Illuminate\Foundation\Http\FormRequest;
// Otros
use Illuminate\Support\Facades\Crypt;

class UpdateMaterialRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_material = Crypt::decrypt($this->id_material);
    return [
      'sku'                       => 'required|max:30|unique:materiales,sku,'.$id_material,
      'descripcion_en_ingles'     => 'required|max:30000|string',
      'lob'                       => 'required|max:30',
      'product_line'              => 'required|max:50',
      'product_line_sub_group'    => 'required|max:50',
      'familia_de_producto'       => 'required|max:60',
      'linea_de_producto'         => 'required|max:60',
      'sub_linea_de_producto'     => 'required|max:60',
      'precio_lista_pagina'       => 'required|min:0|numeric|alpha_decimal18',
      'descuento'                 => 'required|min:0|numeric|alpha_decimal18',
      'precio_pagina_al_cliente'  => 'required|min:0|numeric|alpha_decimal18',
    ];
  }
}