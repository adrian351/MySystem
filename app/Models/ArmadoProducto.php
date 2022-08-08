<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ArmadoProducto extends Model{
  protected $table='armado_tiene_productos';
  protected $primaryKey='id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];

  public function armado(){
    return $this->belongsTo('App\Models\Armado')->orderBy('id', 'DESC');
  }
}