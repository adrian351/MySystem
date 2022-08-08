<?php
namespace App\Http\Requests\cotizacion;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCotizacionRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'comentarios'         => 'nullable|max:30000|string',
      'comentarios_ventas'  => 'nullable|max:30000|string',
    ];
  }
}