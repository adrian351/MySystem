<?php
namespace App\Http\Requests\factura;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFacturaRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'estatus_factura' => 'required|in:'. config('app.error_del_cliente'),
      'comentarios'     => 'nullable|required_if:estatus_factura,'.config('app.error_del_cliente').'|max:30000|string',
    ];
  }
}