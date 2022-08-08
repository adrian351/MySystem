<?php
namespace App\Http\Requests\venta\pedidoActivo\armado;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class DividirDireccionArmadoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {

    return [
        'id_direccion' => 'required|numeric',
        'cantidad_dir'  => 'required|numeric',
        'cant_div'      => 'nullable|numeric|min:1',
        'div_todo'      => 'nullable|in:off,on'
    ];
  }

  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'cant_div' => 'cantidad a dividir',
    ];
  }
}