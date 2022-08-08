<?php
namespace App\Http\Requests\almacen\pedidoActivo;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePedidoActivoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'persona_que_recibe'  => 'required|max:80',
      'comentario_almacen'  => 'nullable|max:30000|string',
      'imagen'              => 'required|max:1024|image',
      'checkbox_imagen'     => 'in:on,off',
    ];
  }
}