<?php
namespace App\Http\Requests\produccion\pedidoActivo\armadoPedidoActivo;
use Illuminate\Foundation\Http\FormRequest;

class UpdateModalArmadoPedidoActivoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'ubicacion_rack'          => 'required|max:50|min:1|string',
    ];
  }
}