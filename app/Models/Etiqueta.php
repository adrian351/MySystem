<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
class Etiqueta extends Model{
    use SoftDeletes;
    use SoftCascadeTrait;

    protected $table = 'etiquetas';
    protected $primaryKey='id';
    protected $guarded = [];

    protected $dates = ['deleted_at'];

     // Define si vera todos los registros de la tabla o solo los que se le asignaron o los que usuario registro (on = todos los registros null = solo sus registros)
    public function scopeAsignado($query, $opcion_asignado, $usuario) {
        if($opcion_asignado == null){
            return $query->where('asignado_eti', $usuario);
        }
    }

    public function scopeBuscar($query, $opcion_buscador, $buscador) {
        if($opcion_buscador != null) {
          return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
        }
    }

    public function producto(){
        return $this->belongsToMany(Producto::class, 'producto_has_etiqueta', 'etiqueta_id', 'producto_id');
    }

}
