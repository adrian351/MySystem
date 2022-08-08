<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class CotizacionArmadoProductos extends Model {
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table='cotizacion_armado_tiene_productos';
  protected $primaryKey='id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
//  protected $softCascade = []; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  public function armado() {
    return $this->belongsTo('App\Models\CotizacionArmado')->orderBy('id','DESC');
  }
}