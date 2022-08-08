<?php
namespace App\Http\Requests\sistema\notificacion;
use Illuminate\Foundation\Http\FormRequest;

class StoreNotificacionRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'todos_los_usuarios'        => 'in:on,off',
      'todos_los_clientes'        => 'in:on,off',
      'usuario'                   => 'required_without_all:todos_los_usuarios,todos_los_clientes|exists:users,id', //|array
      'asunto'                    => 'required|max:20',
      'diseno_de_la_notificacion' => 'required',
    ];
  }
  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'diseno_de_la_notificacion'    => 'diseño de la notificación',
    ];
  }
}