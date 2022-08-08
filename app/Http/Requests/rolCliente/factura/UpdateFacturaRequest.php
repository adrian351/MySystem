<?php
namespace App\Http\Requests\rolCliente\factura;
use Illuminate\Foundation\Http\FormRequest;
// Otros
use Illuminate\Support\Facades\Auth;

class UpdateFacturaRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $cliente_id = Auth::user()->id;
    return [      
      'nombre_o_razon_social'   => 'required|max:60',
      'rfc'                     => 'required|min:12|max:20',
      'lada_telefono_fijo'      => 'nullable|max:9999|min:1|numeric|required_with:telefono_fijo',
      'telefono_fijo'           => 'nullable|max:15|alpha_solo_numeros_guiones|required_with:lada_telefono_fijo',
      'extension'               => 'max:10',
      'lada_telefono_movil'     => 'required|max:9999|min:1|numeric',
      'telefono_movil'          => 'required|max:15|alpha_solo_numeros_guiones',
      'calle'                   => 'required|max:45',
      'no_exterior'             => 'required|max:8',
      'no_interior'             => 'nullable|max:30',
      'pais'                    => 'required|max:40',
      'ciudad'                  => 'required|max:50',
      'colonia'                 => 'required|max:40',
      'delegacion_o_municipio'  => 'required|max:50',
      'codigo_postal'           => 'required|max:6',
      'correo'                  => 'required|max:75|email',
    ];
  }
}