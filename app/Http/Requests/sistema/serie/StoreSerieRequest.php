<?php
namespace App\Http\Requests\sistema\serie;
use Illuminate\Foundation\Http\FormRequest;

class StoreSerieRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'input'   => 'required|in:Cotizaciones (Serie),Pedidos (Serie)',
      'value'   => 'required|max:20|alpha_unique_where:series,'. $this->input,
    ];
  }
}