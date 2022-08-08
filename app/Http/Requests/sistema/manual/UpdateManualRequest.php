<?php
namespace App\Http\Requests\sistema\manual;
use Illuminate\Foundation\Http\FormRequest;
// Otros
use Illuminate\Support\Facades\Crypt;

class UpdateManualRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_manual = Crypt::decrypt($this->id_manual);
    return [
      'usuario_que_puede_visualizarlo'  => 'required|in:Usuario,Cliete,Ambos',
      'valor'                           => 'required|max:42|unique:manuales,valor,'.$id_manual,
      'archivo_editable'                => 'required|max:3000|file',
      'archivo'                         => 'nullable|max:3000|mimes:pdf,jpg,jpeg,png',
    ];
  }
}