<?php
namespace App\Http\Requests\proveedor;
use Illuminate\Foundation\Http\FormRequest;

class UpdateValidadoProveedorRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'proveedor_validado'  => 'required|in:Si,No',
    ];
  }
}