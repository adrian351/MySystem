<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model{
  protected $table = 'jobs';
  protected $primaryKey = 'id';
  protected $guarded = [];

  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
}
