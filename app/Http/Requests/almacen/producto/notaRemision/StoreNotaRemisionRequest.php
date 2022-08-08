<?php
namespace App\Http\Requests\almacen\producto\notaRemision;
use Illuminate\Foundation\Http\FormRequest;

class StoreNotaRemisionRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      "cantidad"    => "required|min:0|numeric|max:99999",
      "alm_sal"     => 'required|in:Naucalpan,Temas',
      // "alm_ent"     => 'nullable|required_if:alm_sal,Naucalpan,Temas',
      'alm_ent'     => 'required|string',
      'per_aprueba' => 'required|max:50|string',
      "per_lleva"   => "required|max:50|string",
      "coment"      => "nullable|max:3000|string"
    ];
  }
}