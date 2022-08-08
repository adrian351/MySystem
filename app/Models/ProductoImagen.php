<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class ProductoImagen extends Model {
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table='producto_imagenes';
  protected $primaryKey='id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
//  protected $softCascade = []; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  public function producto(){
    return $this->belongsTo('App\Models\Producto')->orderBy('id','DESC');
  } 
}