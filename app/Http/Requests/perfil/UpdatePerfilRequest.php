<?php
namespace App\Http\Requests\perfil;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePerfilRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'nombre'              => 'required|max:40|string',
      'apellidos'           => 'required|max:40|string',
      'correo_de_acceso'    => 'required|max:75|email|unique:users,email,' . Auth::user()->id,
      'password'            => 'nullable|max:60|min:8|confirmed',
      'correo_secundario'   => 'nullable|max:75|email|different:correo_de_registro|different:correo_de_acceso',
      'lada_telefono_fijo'  => 'nullable|max:9999|min:1|numeric|required_with:telefono_fijo',
      'telefono_fijo'       => 'nullable|max:15|alpha_solo_numeros_guiones|required_with:lada_telefono_fijo',
      'extension'           => 'max:10',
      'lada_telefono_movil' => 'required|max:9999|min:1|numeric',
      'telefono_movil'      => 'required|max:15|alpha_solo_numeros_guiones',
      'empresa'             => 'max:200',
      'imagen'              => 'nullable|max:1024|image',
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