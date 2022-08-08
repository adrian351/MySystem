<?php
namespace App\Repositories\servicio\fOpen;

interface ServiceFopenInterface {
  public function fopen($ruta, $nombre, $contenido);

  public function eliminarFicherosBlade($ruta);

  public function eliminarFicheroBlade($ruta);
}