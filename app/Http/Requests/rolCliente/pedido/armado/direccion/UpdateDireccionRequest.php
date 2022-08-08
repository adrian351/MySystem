<?php
namespace App\Http\Requests\rolCliente\pedido\armado\direccion;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDireccionRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    if($this->tarjeta_disenada_por_el_cliente_url == null) {
      $validacion = 'nullable|max:1024|file|required_if:tipo_de_tarjeta_de_felicitacion,'.config('opcionesSelect.select_tarjeta_de_felicitacion.Diseñada por el cliente');
    } else {
      $validacion = 'nullable|max:1024|file';
    }
    return [
      'tipo_de_tarjeta_de_felicitacion' => 'nullable|in:'.
                                                          config('opcionesSelect.select_tarjeta_de_felicitacion.Estandar').','.
                                                          config('opcionesSelect.select_tarjeta_de_felicitacion.Entregada por el cliente').','.
                                                          config('opcionesSelect.select_tarjeta_de_felicitacion.Personalizada').','.
                                                          config('opcionesSelect.select_tarjeta_de_felicitacion.Diseñada por el cliente').','.
                                                          config('opcionesSelect.select_tarjeta_de_felicitacion.Sin tarjeta'),
      'tarjeta_disenada_por_el_cliente' => $validacion,
      
      'mensaje_de_dedicatoria'      => 'nullable|max:30000|string|required_if:tipo_de_tarjeta_de_felicitacion,'.config('opcionesSelect.select_tarjeta_de_felicitacion.Personalizada'),
      'nombre_de_la_persona_que_recibe_uno'    => 'required|max:30000|string',
      'nombre_de_la_persona_que_recibe_dos'    => 'nullable|max:30000|string',
      // 'lada_telefono_fijo'          => 'nullable|max:9999|min:1|numeric|required_with:telefono_fijo',
      'telefono_fijo'               => 'nullable|max:15|alpha_solo_numeros_guiones',
      'extension'                   => 'max:10',
      // 'lada_telefono_movil'         => 'required|max:9999|min:1|numeric',
      'telefono_movil'              => 'required|max:15|alpha_solo_numeros_guiones',
      'calle'                       => 'required|max:45',
      'no_exterior'                 => 'required|max:8',
      'no_interior'                 => 'nullable|max:30',
      'pais'                        => 'nullable|max:40',
      'ciudad'                      => 'required|max:50',
      'colonia'                     => 'required|max:40',
      'delegacion_o_municipio'      => 'required|max:50',
      'codigo_postal'               => 'required|max:6',
      'referencias_zona_de_entrega' => 'nullable|max:30000|string',
    ];
  }
  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'tarjeta_disenada_por_el_cliente'    => 'Tarjeta diseñada por el cliente',
    ];
  }
}