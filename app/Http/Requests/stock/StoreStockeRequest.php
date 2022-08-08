<?php
namespace App\Http\Requests\stock;
use Illuminate\Foundation\Http\FormRequest;

class StoreStockeRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'armado'    => 'required|exists:armados,id',
      'cantidad'  => 'required|numeric|min:0|max:99999',
    ];
  }
}