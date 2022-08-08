<?php

namespace App\Models;

use App\Models\Dominio;
use App\Models\Email;
use App\Models\Logotipo;
use App\Models\Armado;
use App\Models\Telefono;
use Illuminate\Auth\Events\Logout;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marcas';
    protected $primaryKey='id';
    protected $guarded = [];

    public function scopeBuscar($query, $opcion_buscador, $buscador) {
        if($opcion_buscador != null) {
          return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
        }
    }

    public function armados(){
        return $this->belongsToMany(Armado::class, 'marcas_has_armados', 'marca_id', 'armado_id')->select(['armados.nom','armados.id', 'armados.sku', 'armados.arm_de_cat', 'armados.stock']);
    }

    public function telefono()
    {
        return $this->belongsToMany(Telefono::class, 'marcas_has_telefonos')
            ->withPivot('marca_id', 'telefono_id');
    }

    public function dominio()
    {
        return $this->belongsToMany(Dominio::class, 'marcas_has_dominios', 'marca_id', 'dominio_id');
    }

    public function email()
    {
        return $this->belongsToMany(Email::class, 'marcas_has_emails', 'marca_id', 'email_id');
    }

    public function logotipos()
    {
        return $this->belongsToMany(Logotipo::class, 'marcas_has_logotipos', 'marca_id', 'logotipo_id');
    }
}
