<?php
namespace App\Http\Requests\rol;
use Illuminate\Foundation\Http\FormRequest;

class StoreRolRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'nombre_del_rol'  => 'required|max:80|unique:roles,nom|string',
      'slug'            => 'required|max:40|unique:roles,name|string',
      'permisos'        => 'required|exists:permissions,id|array',
      'descripcion'     => 'nullable|max:30000|string',
    ];
  }
}