<?php
namespace App\Http\Requests\perfil;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalizarRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'idioma'                              => 'required|in:es,en',
      'color_barra_de_navegacion'           => 'required|in:navbar-dark navbar-primary,navbar-dark navbar-secondary,navbar-dark navbar-info,navbar-dark navbar-success,navbar-dark navbar-danger,navbar-dark navbar-indigo,navbar-dark navbar-purple,navbar-dark navbar-pink,navbar-dark navbar-teal,navbar-dark navbar-cyan,navbar-dark,navbar-dark navbar-gray-dark,navbar-dark navbar-gray,navbar-light,navbar-light navbar-warning,navbar-light navbar-white,navbar-light navbar-orange',
      'color_barra_lateral_oscura_o_clara'  => 'required|in:sidebar-dark-primary,sidebar-dark-warning,sidebar-dark-info,sidebar-dark-danger,sidebar-dark-success,sidebar-dark-indigo,sidebar-dark-navy,sidebar-dark-purple,sidebar-dark-fuchsia,sidebar-dark-pink,sidebar-dark-maroon,sidebar-dark-orange,sidebar-dark-lime,sidebar-dark-teal,sidebar-dark-olive,sidebar-light-primary,sidebar-light-warning,sidebar-light-info,sidebar-light-danger,sidebar-light-success,sidebar-light-indigo,sidebar-light-navy,sidebar-light-purple,sidebar-light-fuchsia,sidebar-light-pink,sidebar-light-maroon,sidebar-light-orange,sidebar-light-lime,sidebar-light-teal,sidebar-light-olive',
      'color_logotipo'                      => 'required|in:navbar-primary,navbar-secondary,navbar-info,navbar-success,navbar-danger,navbar-indigo,navbar-purple,navbar-pink,navbar-teal,navbar-cyan,navbar-dark,navbar-gray-dark,navbar-gray,navbar-light,navbar-warning,navbar-white,navbar-orange,',
    ];
  }
}