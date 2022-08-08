<?php
namespace App\Repositories\perfil\perfil\personalizar;
// Repositories
use App\Repositories\usuario\UsuarioRepositories;
// Otros
use Illuminate\Support\Facades\Auth;

class PersonalizarRepositories implements PersonalizarInterface {
  protected $usuarioRepo;
  public function __construct(UsuarioRepositories $usuarioRepositories) {
    $this->usuarioRepo   = $usuarioRepositories;
  } 
  public function update($request) {
    $personalizar                           = $this->usuarioRepo->getUsuarioFindOrFail(Auth::user()->id, []);
    $personalizar->lang                     = $request->idioma;
    $personalizar->col_barr_de_naveg        = $request->color_barra_de_navegacion;
    $personalizar->col_barr_lat_oscu_o_clar = $request->color_barra_lateral_oscura_o_clara;

    $opcion = substr($personalizar->col_barr_lat_oscu_o_clar, 0, 13);
    if($opcion == 'sidebar-light') {
      $personalizar->col_barr_lat_der_oscu_o_clar = config('opcionesSelect.select_color_barra_lateral_derecha_oscura_o_clara.control-sidebar-light border-left');
    } elseif($opcion == 'sidebar-dark-') {
      $personalizar->col_barr_lat_der_oscu_o_clar = config('opcionesSelect.select_color_barra_lateral_derecha_oscura_o_clara.control-sidebar-dark');
    }

    $personalizar->col_logot                = $request->color_logotipo;
    $personalizar->save();
    return $personalizar;
  }
}