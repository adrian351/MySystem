<?php
namespace App\Http\Requests\almacen\pedidoActivo\armadoPedidoActivo\sustitutoArmado;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class UpdateSustitutoArmadoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    if(is_numeric($this->cantidad)) {
      $id_producto            = Crypt::decrypt($this->id_producto);
      $producto_armado_pedido = \App\Models\PedidoArmadoTieneProducto::with('sustitutos', 'armado')->findOrFail($id_producto);
      $sum_cant_sustitutos    = $producto_armado_pedido->sustitutos()->sum('cant');
      $maximo                 = $producto_armado_pedido->armado->cant * $producto_armado_pedido->cant;
      $max_sustitutos         = $maximo - $sum_cant_sustitutos;
    } else {
      $max_sustitutos = 0;
    }
    return [
      'cantidad'  => 'required|integer|min:1|max:'.$max_sustitutos,
      'sustituto' => 'required|exists:productos,id',
    ];
  }
}