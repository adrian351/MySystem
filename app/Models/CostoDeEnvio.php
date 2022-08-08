<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class CostoDeEnvio extends Model {
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table='costos_de_envio';
  protected $primaryKey='id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
// protected $softCascade = []; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  // Define si vera todos los registros de la tabla o solo los que se le asignaron o los que usuario registro (on = todos los registros null = solo sus registros)
  public function scopeAsignado($query, $opcion_asignado, $usuario) {
    if($opcion_asignado == null) {
      return $query->where('asignado_env', $usuario);
    }
  }
  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
  public function scopeMetodoDeEntrega($query, $metodo_de_entrega) {
    if($metodo_de_entrega != null) {
      return $query->where('met_de_entreg', 'LIKE', "%$metodo_de_entrega%");
    }
  }
  public function scopeEstado($query, $estado) {
    if($estado != null) {
      return $query->where('est', 'LIKE', "%$estado%");
    }
  }
  public function scopeTipoDeEnvio($query, $tipo_de_envio) {
    if($tipo_de_envio != null) {
      return $query->where('tip_env', 'LIKE', "%$tipo_de_envio%");
    }
  }
  public function scopeTamano($query, $tamano) {
    if($tamano != null) {
      return $query->where('tam', 'LIKE', "%$tamano%");
    } else {
      return $query->where('tam', 'Grande');
    }
  }
  public function scopeSinSeleccion($query, $metodo_de_entrega, $estado, $tipo_de_envio, $tamano) {
    if($metodo_de_entrega == null AND $estado == null AND $tipo_de_envio == null AND $tamano == null) {
      return $query->where('id', '!"#$%&/()(/&%$');
    }
  }
}