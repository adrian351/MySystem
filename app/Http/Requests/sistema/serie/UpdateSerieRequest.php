<?php
namespace App\Http\Requests\sistema\serie;
use Illuminate\Foundation\Http\FormRequest;
// Otros
use Illuminate\Support\Facades\Crypt;

class UpdateSerieRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_serie = Crypt::decrypt($this->id_serie);
    return [
      'input'   => 'required|in:Cotizaciones (Serie),Pedidos (Serie)',
      'value'   => 'required|max:20|alpha_unique_where:series,'. $this->input . ',' . $id_serie,
    ];
  }
}