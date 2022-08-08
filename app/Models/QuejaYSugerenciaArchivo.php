<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class QuejaYSugerenciaArchivo extends Model {
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table = 'quejas_y_sugerencias_archivos';
  protected $primaryKey = 'id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
//  protected $softCascade = []; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA
  
  public function quejaYSugerencia(){
    return $this->belongsTo('App\QuejaYSugerencia')->orderBy('id','DESC');
  }
}