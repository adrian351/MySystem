<?php
namespace App\Http\Requests\cotizacion\armadoCotizacion\direccionArmado;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class UpdateDireccionArmadoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_direccion   = $this->id_direccion;
    $direccion      = \App\Models\CotizacionArmadoTieneDirecciones::with('armado')->findOrFail($id_direccion);
    $direccion->armado->cant;
    $cargados       = $direccion->armado->cant_direc_carg - $direccion->cant;
    $dir_permitidas = $direccion->armado->cant - $cargados;

    return [
      'cantidad'                  => 'required|numeric|min:0|max:'.$dir_permitidas,
      // 'detalles_de_la_ubicacion'  => 'required|max:150',
    ];
  }
}