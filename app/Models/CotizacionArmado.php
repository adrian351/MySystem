<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class CotizacionArmado extends Model {
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table='cotizacion_tiene_armados';
  protected $primaryKey='id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
  protected $softCascade = ['productos', 'direcciones']; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  public function cotizacion() {
    return $this->belongsTo('App\Models\Cotizacion')->orderBy('id', 'DESC');
  }
  public function productos() {
    return $this->hasMany('App\Models\CotizacionArmadoProductos', 'armado_id')->orderBy('id', 'DESC');
  }
  public function direcciones() {
    return $this->hasMany('App\Models\CotizacionArmadoTieneDirecciones', 'armado_id')->orderBy('id', 'DESC');
  }
}