<?php
namespace App\Http\Requests\venta\pedidoActivo\archivo;
use Illuminate\Foundation\Http\FormRequest;

class StoreArchivoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'nombre'        => 'required|max:40',
      "archivos"      => "required|array",
      "archivos.*"    => "required|file|max:1024",
    ];
  }
}