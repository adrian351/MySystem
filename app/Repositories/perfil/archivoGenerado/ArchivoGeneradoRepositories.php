<?php
namespace App\Repositories\perfil\archivoGenerado;
use Illuminate\Support\Facades\Auth;

class ArchivoGeneradoRepositories implements ArchivoGeneradoInterface {
  public function getPagination($request) {
    if($request->opcion_buscador != null) {
      return Auth::user()->notifications()->where('type', 'App\Notifications\servicio\NotificacionAchivoGenerado')->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->orderBy('id', 'DESC')->paginate($request->paginador);
    } else {
      return Auth::user()->notifications()->where('type', 'App\Notifications\servicio\NotificacionAchivoGenerado')->orderBy('id', 'DESC')->paginate($request->paginador);
    }
  }
}