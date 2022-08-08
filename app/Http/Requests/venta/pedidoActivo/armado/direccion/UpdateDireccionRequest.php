<?php
namespace App\Http\Requests\venta\pedidoActivo\armado\direccion;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDireccionRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'checkbox_direccion'                     => 'in:on,off',
      'nombre_de_la_persona_que_recibe_uno'    => 'required|max:30000|string',
      'nombre_de_la_persona_que_recibe_dos'    => 'nullable|max:30000|string',
      'lada_telefono_fijo'          => 'nullable|max:9999|min:1|numeric',
      'telefono_fijo'               => 'nullable|max:15|alpha_solo_numeros_guiones',
      'extension'                   => 'max:10',
      'lada_telefono_movil'         => 'nullable|max:9999|min:1|numeric',
      'telefono_movil'              => 'required|max:15|alpha_solo_numeros_guiones',
      'calle'                       => 'required|max:45',
      'no_exterior'                 => 'required|max:8',
      'no_interior'                 => 'nullable|max:30',
      // 'pais'                        => 'max:40|',
      'ciudad'                      => 'required|max:50',
      'colonia'                     => 'required|max:40',
      'delegacion_o_municipio'      => 'required|max:50',
      'codigo_postal'               => 'required|max:6',
      'referencias_zona_de_entrega' => 'required|max:30000|string',
    ];
  }
  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'tarjeta_disenada_por_el_cliente'    => 'Tarjeta diseñada por el cliente',
    ];
  }
}