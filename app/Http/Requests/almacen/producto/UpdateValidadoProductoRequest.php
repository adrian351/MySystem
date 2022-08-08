<?php
namespace App\Http\Requests\almacen\producto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateValidadoProductoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'producto_validado'  => 'required|in:Si,No',
    ];
  }
}