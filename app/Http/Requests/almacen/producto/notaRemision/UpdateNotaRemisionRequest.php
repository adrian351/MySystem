<?php
namespace App\Http\Requests\almacen\producto\notaRemision;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class UpdateNotaRemisionRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {

    $id_nota = Crypt::decrypt($this->id_nota);
    $cant = \App\Models\NotaRemisionProducto::select('cant_envio')->findOrFail($id_nota);

    return [
        'per_recibe'        => 'required|max:60|string',
        'cant_recibida'     => 'required|numeric|max: '.$cant->cant_envio.'|min:0',
    ];
  }

  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'cant_recibida'    => 'cantidad recibida',
    ];
  }
}