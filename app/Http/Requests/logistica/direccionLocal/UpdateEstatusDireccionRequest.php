<?php
namespace App\Http\Requests\logistica\direccionLocal;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEstatusDireccionRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'estatus'          => 'required|in:'.config('app.sin_entrega_por_falta_de_informacion').','.config('app.intento_de_entrega_fallido').','.config('app.productos_completos'),
      'comentario_estatus' => 'nullable|max:30000|string',
    ];
  }
}