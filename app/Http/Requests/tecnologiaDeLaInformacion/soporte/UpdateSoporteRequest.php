<?php
namespace App\Http\Requests\tecnologiaDeLaInformacion\soporte;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSoporteRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'estatus_del_soporte'           => 'required|max:70|in:En espera de compra,Terminado',
      'nombre_del_tecnico'            => 'required|max:80',
      'id_inventario'                 => 'required|exists:inventario_equipos,id',
      'agrupacion_de_fallas'          => 'required|exists:catalogos,value',
      'solucion'                      => 'required|max:30000|string',
      'observaciones_del_equipo'      => 'nullable|max:30000|string',
    ];
  }
}