<?php
namespace App\Http\Requests\cotizacion\armadoCotizacion;
use Illuminate\Foundation\Http\FormRequest;

class StoreArmadoCotizacionRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'id_armado'    => 'required|exists:armados,id',
      'usar_stock'   => 'required|in:Si,No',
    ];
  }
  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'id_armado' => 'armado',
    ];
  }
}