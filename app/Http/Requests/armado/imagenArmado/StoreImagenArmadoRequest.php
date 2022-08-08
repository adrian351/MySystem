<?php
namespace App\Http\Requests\armado\imagenArmado;
use Illuminate\Foundation\Http\FormRequest;

class StoreImagenArmadoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      "imagenes"      => "required|array",
      "imagenes.*"    => "required|image|max:1024",
    ];
  }
}