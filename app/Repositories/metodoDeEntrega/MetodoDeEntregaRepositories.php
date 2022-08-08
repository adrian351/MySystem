<?php
namespace App\Repositories\metodoDeEntrega;
// Models
use App\Models\MetodoDeEntrega;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class MetodoDeEntregaRepositories implements MetodoDeEntregaInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function metodoFindOrFailById($id_metodo, $relaciones) { //'contactos', 'productos'
    $id_metodo = $this->serviceCrypt->decrypt($id_metodo);
    $metodo = MetodoDeEntrega::with($relaciones)->findOrFail($id_metodo);
    return $metodo;
  }
  public function metodoFindOrFailByNombreMetodo($nom_met_ent, $relaciones) {
    $metodo = MetodoDeEntrega::with($relaciones)->where('nom_met_ent', $nom_met_ent)->firstOrFail();
    return $metodo;
  }
  public function getAllMetodosForaneoOLocalPluck($for_loc) {
    $consulta = MetodoDeEntrega::where('for_loc', $for_loc)->orWhere('for_loc', 'Foráneo y Local')->orderBy('nom_met_ent', 'ASC')->pluck('nom_met_ent', 'nom_met_ent');
    return $consulta;
  }
  public function getAllMetodosPluck() {
    $consulta = MetodoDeEntrega::pluck('nom_met_ent', 'nom_met_ent');
    return $consulta;
  }
}