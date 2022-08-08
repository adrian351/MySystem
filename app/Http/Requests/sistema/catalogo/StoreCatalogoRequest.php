<?php
namespace App\Http\Requests\sistema\catalogo;
use Illuminate\Foundation\Http\FormRequest;

class StoreCatalogoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'input'	  => 'required|in:Armados (Gama),Armados (Tipo),Productos (Categoría),Productos (Etiqueta),Soportes (Agrupación de fallas),Productos (Marca)',
      'value'   => 'required|max:150|alpha_unique_where:catalogos,'. $this->input,
    ];
  }
}