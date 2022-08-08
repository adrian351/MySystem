<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class HistorialArchivo extends Model {
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table = 'historiales_archivos';
  protected $primaryKey = 'id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
 // protected $softCascade = []; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  public function historial(){
    return $this->belongsTo('App\Models\Historial', 'historial_id')->orderBy('id', 'DESC');
  }
}
