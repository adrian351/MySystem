<?php
namespace App\Models;
use App\Models\Marca;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Armado extends Model{
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table='armados';
  protected $primaryKey='id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
  protected $softCascade = ['imagenes']; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  // Define si vera todos los registros de la tabla o solo los que se le asignaron o los que usuario registro (on = todos los registros null = solo sus registros)
  public function scopeAsignado($query, $opcion_asignado, $usuario) {
    if($opcion_asignado == null){
      return $query->where('asignado_arm', $usuario);
    }
  }
  // Buscador
  // public function scopeBuscar($query, $opcion_buscador, $buscador) {
  //   if($opcion_buscador != null) {
  //     return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
  //   }
  // }

  public function scopeBuscar($query, $opcion_buscador, $buscador){
    if($buscador != null){
      if($opcion_buscador == 'marca'){
        return  $query->when($opcion_buscador, function ($query) use ($opcion_buscador, $buscador) {
                $query->whereHas('marca', function ($query) use ($opcion_buscador, $buscador) {
                  $query->where($opcion_buscador, 'LIKE', "%$buscador%");
                });
        });
      }else{
        return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
      }
    }
  }

  public function imagenes(){
    return $this->hasMany('App\Models\ArmadoImagen')->orderBy('id', 'DESC');
  } 
  public function productos(){
    return $this->belongsToMany('App\Models\Producto', 'armado_tiene_productos')->withPivot('id', 'cant')->withTimestamps()->orderBy('armado_tiene_productos.id', 'DESC');
  }
  public function stocks() {
    return $this->belongsToMany('App\Models\Stock', 'stock_armados')->withPivot('id')->withTimestamps()->orderBy('stock_armados.id', 'DESC');
  }  

  public function marca(){
    return $this->belongsToMany(Marca::class, 'marcas_has_armados', 'armado_id', 'marca_id');
  }
}