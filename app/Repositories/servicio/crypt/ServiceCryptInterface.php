<?php
namespace App\Repositories\servicio\crypt;

interface ServiceCryptInterface {
  public function encrypt($valor);
  
  public function decrypt($valor);

  public function bcrypt($valor);
}