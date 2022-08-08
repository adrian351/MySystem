<?php
namespace App\Http\Requests\almacen\producto\precio;
use Illuminate\Foundation\Http\FormRequest;

class StorePrecioRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'ano'     => 'required|date_format:Y',
      'precio'  => 'required|min:0|numeric|alpha_decimal15',
    ];
  }
  public function messages() {
    return [
      // Mensaje que se muestra en las diferentes validaciones, por ejemplo "required, max: min: ...".
       'ano.date_format' => 'El campo :attribute debe ser un año valido',
    ];
  }
  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'ano'    => 'año',
    ];
  }
}