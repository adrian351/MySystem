<?php
namespace App\Repositories\servicio\fOpen;

class ServiceFopen implements ServiceFopenInterface {
  public function fopen($ruta, $nombre, $contenido) {
    $archivo=fopen(base_path($ruta . $nombre . '.blade.php'), 'w') or die('Error');
    fwrite($archivo, $contenido);
    return $archivo;
  }
  public function eliminarFicherosBlade($ruta) {
    $archivos = glob(base_path($ruta)); // obtenemos todos los nombres de los ficheros
    foreach($archivos as $archivo) {
      if(is_file($archivo))
      unlink($archivo); // elimina el fichero
    }
  }
  public function eliminarFicheroBlade($ruta) {
    $archivos = glob(base_path($ruta)); // obtenemos todos los nombres de los ficheros
    if(is_file($archivos[0]))
    unlink(base_path($ruta)); // Elimina el fichero
  }
}