<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetodoDeEntregaEspecifico extends Model {
  use SoftDeletes;

  protected $table='metodos_de_entrega_especificos';
  protected $primaryKey='id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];

  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
  public function metodoDeEntrega() {
    return $this->belongsTo('App\Models\MetodoDeEntrega');
  }
}
