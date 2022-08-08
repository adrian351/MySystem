<?php
namespace App\Repositories\sistema\actividad;
// Models
use App\Models\Actividades;

class ActividadRepositories implements ActividadInterface {
  public function getPagination($request) {
    return Actividades::with('usuario')
            ->buscar($request->opcion_buscador_1, $request->buscador_1)
            ->buscar($request->opcion_buscador_2, $request->buscador_2)
            ->buscar($request->opcion_buscador_3, $request->buscador_3)
            ->orderBy('id', 'DESC')->paginate(150);
  }


  public function onlyActividades($request){
    if($request->paginador == null) {
      $paginador = 20;
      // $paginador 
    }else {
      $paginador = $request->paginador;
    }
    // return Actividades::whereDate('created_at', '>=', '2021-11-01')
    return Actividades::whereBetween('created_at', [
      date("Y-m-d", strtotime('-7 day', strtotime(date("Y-m-d")))), 
      date("Y-m-d", strtotime('+1 day', strtotime(date("Y-m-d"))))])
      ->where(function($query){
        $query->where('inpu', 'Tipo de tarjeta de felicitación')
                ->orWhere('inpu', 'Mensaje de dedicatoria')
                  ->orwhere('inpu', 'Comentarios ventas')
                    ->where(function($query){
                      $query->where('mod', 'Ventas (Pedidos activos)')
                              ->orwhere('mod', 'Ventas/Pedido Activo/Armado (direcciones)');
                    });
    })->latest()
    // ->get();
        ->buscar($request->opcion_buscador, $request->buscador) ->paginate($paginador);
          // ->paginate($paginador); 
  }
}