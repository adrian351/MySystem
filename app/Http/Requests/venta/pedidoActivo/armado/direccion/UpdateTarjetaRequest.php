<?php
namespace App\Http\Requests\venta\pedidoActivo\armado\direccion;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTarjetaRequest extends FormRequest {
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
    ];
  }
  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'tarjeta_disenada_por_el_cliente'    => 'Tarjeta diseñada por el cliente',
    ];
  }
}