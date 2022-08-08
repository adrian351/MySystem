<?php
namespace App\Http\Requests\cliente;
use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'nombre'              => 'required|max:40|string',
      'apellidos'           => 'required|max:40|string',
      'correo_de_registro'  => 'required|max:75|email|unique:users,email',
      'correo_secundario'   => 'nullable|max:75|email|different:correo_de_registro',
      'rol'                 => 'required|exists:roles,id|array',
      // 'lada_telefono_fijo'  => 'nullable|max:9999|min:1|numeric|required_with:telefono_fijo',
      // 'telefono_fijo'       => 'nullable|max:15|alpha_solo_numeros_guiones|required_with:lada_telefono_fijo',
      'telefono_fijo'       => 'nullable|max:15|alpha_solo_numeros_guiones',
      'extension'           => 'max:10',
      // 'lada_telefono_movil' => 'required|max:9999|min:1|numeric',
      // 'telefono_movil'      => 'required|max:15|alpha_solo_numeros_guiones',
      'telefono_movil'      => 'nullable|max:15|alpha_solo_numeros_guiones',
      'empresa'             => 'max:200',
      'password'            => 'required|max:60|min:8|confirmed',
      'observaciones'       => 'nullable|max:30000|string',
      'plantilla'           => 'nullable|required_if:checkbox_correo,on|exists:plantillas,id',
      'checkbox_correo'     => 'in:on,off',
      'imagen'              => 'nullable|max:1024|image',
    ];
  }
  public function messages() {
    return [
      // Mensaje que se muestra en las diferentes validaciones, por ejemplo "required, max: min: ...".
      // 'nombre.required' => 'Debe especificar los :attribute',
    ];
  }
  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'nombre'    => 'nombre(s)',
      'password'  => 'contraseña',
    ];
  }
}