<?php
namespace App\Http\Requests\rolCliente\pedido;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePedidoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      // 'fecha_de_entrega'        => 'nullable|date',
      // 'se_puede_entregar_antes' => 'nullable',
      // 'cuantos_dias_antes'      => 'nullable',
      'comentarios'             => 'nullable|max:30000|string',
    ];
  }
}