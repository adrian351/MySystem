<?php
namespace App\Http\Requests\almacen\producto\sustitutoProducto;
use Illuminate\Foundation\Http\FormRequest;

class StoreSustitutoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'ids_sustituto' => 'required|exists:productos,id|array',
    ];
  }
  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'ids_sustituto' => 'sustitutos',
    ];
  }
}