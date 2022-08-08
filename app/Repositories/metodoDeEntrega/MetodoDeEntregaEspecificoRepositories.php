<?php
namespace App\Repositories\metodoDeEntrega;
// Models
use App\Models\MetodoDeEntregaEspecifico;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class MetodoDeEntregaEspecificoRepositories implements MetodoDeEntregaEspecificoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function metodoEspecificoFirstByNombreMetodo($nom_met, $relaciones) {
    $metodo = MetodoDeEntregaEspecifico::with($relaciones)->where('nom_met_ent_esp', $nom_met)->first();
    return $metodo;
  }
}