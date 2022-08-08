<?php
namespace App\Http\Requests\almacen\producto\imagen;
use Illuminate\Foundation\Http\FormRequest;

class StoreImagenRequest extends FormRequest {
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