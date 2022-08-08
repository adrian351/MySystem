<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class PedidoArmadoTieneProducto extends Model{
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table='pedido_armado_tiene_productos';
  protected $primaryKey='id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
  protected $softCascade = ['sustitutos']; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  public function armado(){
    return $this->belongsTo('App\Models\PedidoArmado', 'pedido_armado_id')->orderBy('id', 'DESC');
  }
  public function sustitutos(){
    return $this->hasMany('App\Models\PedidoArmadoProductoTieneSustituto', 'producto_id')->orderBy('id', 'DESC');
  }
  public function productos_original(){
    return $this->belongsToMany('App\Models\Producto', 'prod_orig_tiene_prod_ped')->withTimestamps();
  }
}