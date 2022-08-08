<?php
namespace App\Http\Requests\cotizacion;
use Illuminate\Foundation\Http\FormRequest;

class UpdateIvaCotizacionRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'iva' => 'in:on,off',
    ];
  }
}