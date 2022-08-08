<?php
namespace App\Http\Requests\almacen\producto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDisminuirStockRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'disminuir_stock_naucalpan' => 'nullable|min:1|max:99999999|integer',
      'disminuir_stock_temas' => 'nullable|min:1|max:99999999|integer'
    ];
  }
}