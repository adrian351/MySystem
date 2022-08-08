<?php
namespace App\Http\Requests\venta\pedidoActivo\armado;
use Illuminate\Foundation\Http\FormRequest;

class UpdateArmadoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'comentarios_adicionales' => 'nullable|max:30000|string',
    ];
  }
}