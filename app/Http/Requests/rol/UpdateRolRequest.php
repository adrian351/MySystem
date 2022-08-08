<?php
namespace App\Http\Requests\rol;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class UpdateRolRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_rol = Crypt::decrypt($this->id_rol);
    return [
      'nombre_del_rol'  => 'required|max:80|string|unique:roles,nom,' . $id_rol,
      'permisos'        => 'required|exists:permissions,id|array',
      'descripcion'     => 'nullable|max:30000|string',
    ];
  }
}