<?php
namespace App\Http\Requests\venta\pedidoActivo\armado\direccion;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCantidadRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'cantidad_por_direccion'      => 'nullable|min:1|numeric',
    ];
  }
  public function attributes() {
    return [
    // Nombre del campo a mostrar.
      'cantidad_por_direccion'  => 'CANT.',
    ];
  }
}