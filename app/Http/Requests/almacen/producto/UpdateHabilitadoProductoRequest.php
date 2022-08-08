<?php
namespace App\Http\Requests\almacen\producto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateHabilitadoProductoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'habilitar_o_deshabilitar'  => 'required|in:Habilitado,Deshabilitado',
    ];
  }
}