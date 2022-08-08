<?php
namespace App\Http\Requests\tecnologiaDeLaInformacion\inventarioEquipo;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInventarioEquipoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'responsable'           => 'required|max:80',
      'empresa'               => 'required|max:100',
      'marca'                 => 'required|max:50',
      'modelo'                => 'required|max:50',
      'numero_serie'          => 'required|max:40',
      'ultimo_mantenimiento'  => 'nullable|date',
      'descripciom_equipo'    => 'nullable|max:30000|string',
      'observaciones'         => 'nullable|max:30000|string',
    ];
  }
}
