<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\plantillas;
// Servicios
use App\Repositories\servicio\fOpen\ServiceFopen;

class PlantillasRepositories implements PlantillasInterface {
  protected $serviceFopen;
  public function __construct(ServiceFopen $serviceFopen) { // Interfaz para implementar solo [metodos]
    $this->serviceFopen     = $serviceFopen;
  }
  public function metodo($metodo, $consulta) {
    if($metodo == 'destroy') {
      $this->metDestroy($consulta);
    }
  }
  public function metDestroy($consulta) {
    $this->serviceFopen->eliminarFicheroBlade('resources\views\correo\\' . $consulta->id . '.blade.php');
  }
}