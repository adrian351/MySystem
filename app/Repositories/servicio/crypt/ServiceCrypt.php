<?php
namespace App\Repositories\servicio\crypt;
// Otros
use Illuminate\Support\Facades\Crypt;

class ServiceCrypt implements ServiceCryptInterface {
  // Encripta para los formularios
  public function encrypt($valor) {
    return Crypt::encrypt($valor);
  }
  // Desencripta
  public function decrypt($valor) {
    return Crypt::decrypt($valor);
  }
  // Encripta para la BD
  public function bcrypt($valor) {
    return bcrypt($valor);
  }
}