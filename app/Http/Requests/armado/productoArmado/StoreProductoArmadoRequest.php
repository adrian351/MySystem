<?php
namespace App\Http\Requests\armado\productoArmado;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductoArmadoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'ids_productos'    => 'required|exists:productos,id|array',
    ];
  }
  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'ids_productos' => 'productos',
    ];
  }
}