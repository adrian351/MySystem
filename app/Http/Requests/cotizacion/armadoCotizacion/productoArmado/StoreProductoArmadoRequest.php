<?php
namespace App\Http\Requests\cotizacion\armadoCotizacion\productoArmado;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductoArmadoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'id_producto'    => 'required|exists:productos,id',
    ];
  }
  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'id_producto' => 'Registrar producto',
    ];
  }
}