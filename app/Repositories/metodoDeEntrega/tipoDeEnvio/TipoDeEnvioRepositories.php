<?php
namespace App\Repositories\metodoDeEntrega\tipoDeEnvio;
// Models
use App\Models\TipoDeEnvio;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class TipoDeEnvioRepositories implements TipoDeEnvioInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function getAllTiposDeEnvioPluck($id_metodo_de_entrega) {
    return TipoDeEnvio::where('metodo_de_entrega_id', $id_metodo_de_entrega)->orderBy('tip_de_env', 'ASC')->pluck('tip_de_env');
  }
}