<?php
namespace App\Http\Requests\pago\individual;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePagoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'estatus_pago'    => 'required|in:Aprobado,Rechazado',
      'comentarios'     => 'nullable|required_if:estatus_pago,Rechazado|max:30000|string',  
      'checkbox_correo' => 'in:on,off', 
    ];
  }
}