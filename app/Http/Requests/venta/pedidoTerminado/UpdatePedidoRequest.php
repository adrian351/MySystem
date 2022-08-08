<?php
namespace App\Http\Requests\venta\pedidoTerminado;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePedidoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'estatus'                     => 'required|in:Abierto,Cerrado',
      'tipo'                        => 'required|in:Comentario,Reclamación',
      'comentario_o_reclamacion'    => 'required|max:30000|string',
    ];
  }
}