<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class PedidoArmadoTieneDireccion extends Model {
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table='pedido_armado_tiene_direcciones';
  protected $primaryKey='id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
  protected $softCascade = ['comprobantes']; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  // Buscador
  // public function scopeBuscar($query, $opcion_buscador, $buscador) {
  //   if($opcion_buscador != null) {
  //     return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
  //   }
  // }
  public function scopeBuscar($query, $opcion_buscador, $buscador){
    if($buscador != null){
      return $query->when($opcion_buscador, function ($query) use ($opcion_buscador, $buscador) {
              $query->whereHas('armado', function ($query) use ($opcion_buscador, $buscador) {
                $query->whereHas('pedido', function ($query) use ($opcion_buscador, $buscador) {
                  $query->where($opcion_buscador, 'LIKE', "%$buscador%");
                });
              });
            });
    }
  }

  public function armado() {
    return $this->belongsTo('App\Models\PedidoArmado', 'pedido_armado_id')->orderBy('id','DESC');
  }
  public function comprobantes() {
    return $this->hasMany('App\Models\PedidoArmadoDireccionTieneComprobante', 'direccion_id')->orderBy('id', 'DESC');
  } 
}