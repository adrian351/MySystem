<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FailedJobs extends Model {
  protected $table = 'failed_jobs';
  protected $primaryKey = 'id';
  protected $guarded = [];

  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
}
