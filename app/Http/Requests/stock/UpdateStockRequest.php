<?php
namespace App\Http\Requests\stock;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStockRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'cantidad'  => 'required|numeric|min:0|max:99999',
    ];
  }
}