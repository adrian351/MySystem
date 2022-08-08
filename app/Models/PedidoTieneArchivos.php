<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class PedidoTieneArchivos extends Model{
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table = 'pedido_tiene_archivos';
  protected $primaryKey = 'id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
//    protected $softCascade = []; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  public function pedido() {
    return $this->belongsTo('App\Models\Pedido')->orderBy('id','DESC');
  }
}
