<?php
namespace App\Http\Requests\rolFerro\ruta;
use Illuminate\Foundation\Http\FormRequest;

class StoreRutaRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'nombre_de_la_ruta'   => 'required|max:100|unique:rutas,nom',
    ];
  }
}