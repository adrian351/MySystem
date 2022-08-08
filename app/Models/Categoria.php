<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategoria;
// use Illuminate\Database\Eloquent\SoftDeletes;
// use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
class Categoria extends Model{
    // use SoftDeletes;
    // use SoftCascadeTrait;

    protected $table = 'categorias';
    protected $primaryKey='id';
    protected $guarded = [];

    // protected $dates = ['deleted_at'];

    public function scopeBuscar($query, $opcion_buscador, $buscador) {
        if($opcion_buscador != null) {
          return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
        }
    }


    public function subCategoria(){
        return $this->belongsToMany(SubCategoria::class, 'categorias_has_subcategorias', 'categoria_id', 'sub_categoria_id');
    }

    public function producto(){
        return $this->belongsToMany(Producto::class, 'producto_has_categoria', 'categoria_id', 'producto_id');
    }

}
