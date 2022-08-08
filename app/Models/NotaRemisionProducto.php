<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class NotaRemisionProducto extends Model{
    use SoftDeletes;
    use SoftCascadeTrait;

    protected $table='nota_remision_productos';
    protected $primaryKey='id';
    protected $guarded = [];

    protected $dates = ['deleted_at'];
    protected $softCascade = []; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

    public function scopeAsignado($query, $opcion_asignado, $usuario) {
        if($opcion_asignado == null){
            return $query->where('asignado_not', $usuario);
        }
    }
  // Buscador
    public function scopeBuscar($query, $opcion_buscador, $buscador) {
        if($opcion_buscador != null) {
            return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
        }
    }

    public function producto() {
        return $this->belongsTo('App\Models\Producto', 'producto_id')->orderBy('id','DESC');
    } 

    public static function getEstatusNota($nota){
        if($nota->cant_envio == $nota->cant_recibida){
            $nota->estat = config('app.confirmada');
        }
        if($nota->cant_recibida < $nota->cant_envio){
            $nota->estat = config('app.falta_producto');
        }

        $nota->save();
    }
}
