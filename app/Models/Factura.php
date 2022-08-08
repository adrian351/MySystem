<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Factura extends Model{
  use SoftDeletes;
  use SoftCascadeTrait;
  
  protected $table='facturas';
  protected $primaryKey='id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
 // protected $softCascade = []; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  // Buscador
  // public function scopeBuscar($query, $opcion_buscador, $buscador) {
  //   if($opcion_buscador != null) {
  //     return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
  //   }
  // }

  public function scopeBuscar($query, $opcion_buscador, $buscador){
    if($buscador != null){
      return $query->when($opcion_buscador, function ($query) use ($opcion_buscador, $buscador) {
              $query->whereHas('pago', function ($query) use ($opcion_buscador, $buscador) {
                $query->whereHas('pedido', function ($query) use ($opcion_buscador, $buscador) {
                  $query->where($opcion_buscador, 'LIKE', "%$buscador%");
                });
              });
            });
    }
  }

  public function scopeEstatus($query, $estatus) {
    if($estatus != null) {
      return $query->where('est_fact', '!=', $estatus);
    }
  }
  public function usuario(){
    return $this->belongsTo('App\User', 'user_id')->orderBy('id','DESC');
  }
  public function pago(){
    return $this->belongsTo('App\Models\Pago');
  }
}
