<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class MetodoDeEntrega extends Model {
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table='metodos_de_entrega';
  protected $primaryKey='id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
  protected $softCascade = ['metodos_de_entrega_especificos', 'tipos_de_envio']; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  public function scopeAsignado($query, $opcion_asignado, $usuario) {
    if($opcion_asignado == null){
      return $query->where('asignado_met_ent', $usuario);
    }
  }
  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
  public function metodosDeEntregaEspecificos() {
    return $this->hasMany('App\Models\MetodoDeEntregaEspecifico', 'metodo_de_entrega_id')->orderBy('id', 'DESC');
  }  
  public function tiposDeEnvio() {
    return $this->hasMany('App\Models\TipoDeEnvio')->orderBy('id', 'DESC');
  } 
}
