<?php
namespace App\Http\Requests\produccion\pedidoActivo\armadoPedidoActivo;
use Illuminate\Foundation\Http\FormRequest;

class UpdateArmadoPedidoActivoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'estatus'                 => 'required|in:'.config('app.en_produccion').','.config('app.en_almacen_de_salida').','.config('app.en_revision_de_productos'),
      'ubicacion_rack'          => 'nullable|required_if:estatus,'.config('app.en_almacen_de_salida').'|max:50|min:1|string',
      'comentario_produccion'   => 'nullable|max:30000|string'
    ];
  }
}