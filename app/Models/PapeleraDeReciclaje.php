<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PapeleraDeReciclaje extends Model {
  protected $table = 'papelera_de_reciclaje';
  protected $primaryKey = 'id';
  protected $guarded = [];
  
  // Define si vera todos los registros de la tabla o solo los que se le asignaron o los que usuario registro (on = todos los registros null = solo sus registros)
  public function scopeAsignado($query, $opcion_asignado, $usuario) {
    if($opcion_asignado == null) {
      return $query->where('deleted_at_reg', $usuario);
    }
  }
  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
}
