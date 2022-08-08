<?php
namespace App\Http\Requests\logistica\pedidoActivo\armadoPedidoActivo;
use Illuminate\Foundation\Http\FormRequest;

class UpdateArmadoPedidoActivoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'comentario_armado'   => 'nullable|max:30000|string'
    ];
  }
}