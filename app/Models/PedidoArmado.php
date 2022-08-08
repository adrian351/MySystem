<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class PedidoArmado extends Model{
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table = 'pedido_armados';
  protected $primaryKey = 'id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
  protected $softCascade = ['direcciones', 'productos']; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA
 
  public function pedido() {
    return $this->belongsTo('App\Models\Pedido')->orderBy('id','DESC');
  }
  public function direcciones() {
    return $this->hasMany('App\Models\PedidoArmadoTieneDireccion', 'pedido_armado_id')->orderBy('id','DESC');
  }
  public function productos() {
    return $this->hasMany('App\Models\PedidoArmadoTieneProducto', 'pedido_armado_id')->orderBy('produc','ASC')->where('produc', '!=', 'Armado')
    ->where('produc', '!=', 'Emplayado')
    ->where('produc', '!=', 'Moño')
    ->where('produc', '!=', 'Tarjeta Navideña')
    ->where('produc', '!=', 'Viruta');
  }
}