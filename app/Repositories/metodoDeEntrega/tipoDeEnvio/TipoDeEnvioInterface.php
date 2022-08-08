<?php
namespace App\Repositories\metodoDeEntrega\tipoDeEnvio;

interface TipoDeEnvioInterface {
  public function getAllTiposDeEnvioPluck($id_metodo_de_entrega);
}