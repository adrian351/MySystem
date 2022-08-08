<?php
namespace App\Http\Requests\rolFerro\ruta;
use Illuminate\Foundation\Http\FormRequest;
// Otros
use Illuminate\Support\Facades\Crypt;

class UpdateRutaRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_ruta = Crypt::decrypt($this->id_ruta);
    return [
      'nombre_de_la_ruta'   => 'required|max:100|unique:rutas,nom,' . $id_ruta,
    ];
  }
}