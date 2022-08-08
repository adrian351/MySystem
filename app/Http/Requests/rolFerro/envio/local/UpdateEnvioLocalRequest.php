<?php
namespace App\Http\Requests\rolFerro\envio\local;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEnvioLocalRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'ruta'    => 'required|exists:rutas,rut',
    ];
  }
}