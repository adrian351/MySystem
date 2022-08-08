<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Stock extends Model {
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table='stocks';
  protected $primaryKey='id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
  //  protected $softCascade = ['']; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
  public function armados() {
    return $this->belongsToMany('App\Models\Armado', 'stock_armados')->withPivot('id')->withTimestamps()->orderBy('stock_armados.id', 'DESC');
  }
}