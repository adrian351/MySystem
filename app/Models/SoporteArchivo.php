<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class SoporteArchivo extends Model{
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table = 'soporte_archivos';
  protected $primaryKey = 'id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
  // protected $softCascade = ['']; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA


  public function soporte(){
    return $this->belongsTo('App\Models\Soporte', 'soporte_id')->orderBy('id', 'DESC');
  }
}