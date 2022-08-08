<?php
namespace App\Http\Requests\almacen\producto\proveedorProducto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProveedorProductoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'precio_proveedor'                            => 'required|numeric|alpha_decimal15',
      'utilidad'                                    => 'required|in:.0,.1,.2,.3,.4,.5,.6,.7,.8,.9',
      'precio_cliente'                              => 'required|numeric|alpha_decimal18',
      'mombre_del_producto_que_maneja_el_proveedor' => 'nullable|max:70',
      'codigo_de_fabricante'                        => 'nullable|max:100',
      'tipo_de_iva'                                 => 'nullable|in:on,off',
      'ieps'                                        => 'nullable|in:on,off',
    ];
  }
}