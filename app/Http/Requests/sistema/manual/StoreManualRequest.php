<?php
namespace App\Http\Requests\sistema\manual;
use Illuminate\Foundation\Http\FormRequest;

class StoreManualRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'usuario_que_puede_visualizarlo'  => 'required|in:Usuario,Cliete,Ambos',
      'valor'                           => 'required|max:42|unique:manuales,valor',
      'archivo_editable'                => 'required|max:3000|file',
      'archivo'                         => 'required|max:3000|mimes:pdf,jpg,jpeg,png',
    ];
  }
}