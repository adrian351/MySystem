<?php
namespace App\Http\Requests\venta\pedidoActivo\armado;
use Illuminate\Foundation\Http\FormRequest;

class UpdateArmadoDireccionRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
        'iva' => 'in:on,off',
    ];
  }
}