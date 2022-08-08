<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class InventarioEquipo extends Model {
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table = 'inventario_equipos';
  protected $primaryKey = 'id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
  protected $softCascade = ['archivos', 'historiales']; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  public function archivos() {
    return $this->hasMany('App\Models\InventarioEquipoArchivo')->orderBy('id', 'DESC');
  }
  public function historiales() {
    return $this->hasMany('App\Models\Historial')->orderBy('id', 'DESC');
  }
  // Define si vera todos los registros de la tabla o solo los que se le asignaron o los que usuario registro (on = todos los registros null = solo sus registros)
  public function scopeAsignado($query, $opcion_asignado, $usuario) {
    if($opcion_asignado == null) {
      return $query->where('asignado_inv_equ', $usuario);
    }
  }
  
  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
}