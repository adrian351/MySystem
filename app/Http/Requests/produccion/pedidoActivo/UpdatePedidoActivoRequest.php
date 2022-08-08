<?php
namespace App\Http\Requests\produccion\pedidoActivo;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePedidoActivoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      // 'lider_de_pedido_produccion' => 'nullable|max:80',
      'bodega_donde_se_armara'     => 'required|max:150',
      'comentario_produccion'      => 'nullable|max:30000|string',
    ];
  }
}