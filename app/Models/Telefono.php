<?php

namespace App\Models;

use App\Models\Marca;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    protected $table = 'telefonos';

    public function marcas()
    {
        return $this->belongsToMany(Marca::class, 'marcas_has_telefonos')
            ->withPivot('marca_id', 'telefono_id');
    }
}
