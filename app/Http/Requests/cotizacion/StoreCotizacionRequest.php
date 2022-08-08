<?php
namespace App\Http\Requests\cotizacion;
use Illuminate\Foundation\Http\FormRequest;

class StoreCotizacionRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'validez'                                                     => 'required|date|after:tomorrow',
      'cliente'                                                     => 'required|exists:users,id',
      // quitar campo obligatorio
      // 'describe_esta_cotizacion_para_que_sea_mas_facil_encontrarla' => 'string'
    ];
  }
}