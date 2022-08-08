<?php
namespace App\Http\Requests\cotizacion;
use Illuminate\Foundation\Http\FormRequest;

class UpdateComisionCotizacionRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'comision' => 'in:on,off',
    ];
  }
}