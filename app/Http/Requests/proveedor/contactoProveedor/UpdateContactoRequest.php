<?php
namespace App\Http\Requests\proveedor\contactoProveedor;
use Illuminate\Foundation\Http\FormRequest;

class UpdateContactoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'nombre'              => 'required|max:80',
      'cargo'               => 'required|max:100',
      'correo'              => 'nullable|max:75|email',
      'lada_telefono_fijo'  => 'nullable|max:9999|min:1|numeric|required_with:telefono_fijo',
      'telefono_fijo'       => 'nullable|max:15|alpha_solo_numeros_guiones|required_with:lada_telefono_fijo',
      'extension'           => 'max:10',
      'lada_telefono_movil' => 'required|max:9999|min:1|numeric',
      'telefono_movil'      => 'required|max:15|alpha_solo_numeros_guiones',
      'observaciones'       => 'nullable|max:30000|string',
    ];
  }
}