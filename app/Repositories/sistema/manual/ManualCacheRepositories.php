<?php
namespace App\Repositories\sistema\manual;
// Models
use App\Models\Manual;
// Otros
use Illuminate\Support\Facades\Cache;

class ManualCacheRepositories implements ManualCacheInterface {
  public function allManualesCache() {
    $datos = Cache::rememberForever('allManuales', function() { // Guarda la información en la cache con la llave "sistema"
      return Manual::get();
    });
    return $datos;
  }
}