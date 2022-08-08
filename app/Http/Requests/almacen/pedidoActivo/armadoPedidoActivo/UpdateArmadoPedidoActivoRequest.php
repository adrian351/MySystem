<?php
namespace App\Http\Requests\almacen\pedidoActivo\armadoPedidoActivo;
use Illuminate\Foundation\Http\FormRequest;
// Otros

class UpdateArmadoPedidoActivoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'estatus'              => 'required|in:'.config('app.en_espera_de_compra').','.config('app.en_revision_de_productos').','.config('app.productos_completos').','.config('app.en_almacen_de_salida'),
      'comentario_almacen'   => 'nullable|max:30000|string',
    ];
  }
}