<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Historial extends Model {
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table = 'historiales';
  protected $primaryKey = 'id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
  protected $softCascade = ['historialArchivos']; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  public function equipo() {
    return $this->belongsTo('App\Models\InventarioEquipo', 'inventario_equipo_id')->orderBy('id', 'DESC');
  }            
  public function historialArchivos() {
    return $this->hasMany('App\Models\HistorialArchivo')->orderBy('id', 'DESC');
  }
}
