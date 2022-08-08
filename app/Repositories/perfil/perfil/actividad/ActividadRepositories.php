<?php
namespace App\Repositories\perfil\perfil\actividad;
// Models
use App\Models\Actividades;
// Otros
use Illuminate\Support\Facades\Auth;

class ActividadRepositories implements ActividadInterface {
  public function getPagination($request) {
    return Actividades::where('user_id', Auth::user()->id)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
}