<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\quejasYSugerencias;

class QuejasYSugerenciasRepositories implements QuejasYSugerenciasInterface {
  public function metodo($metodo, $consulta) {
    if($metodo == 'destroy') {
      $this->metDestroy($consulta);
    }
  }
  public function metDestroy($consulta) {
    $cont2 = 0;
    $archivos_a_eliminar = null;

    foreach($consulta as $consulta) {
      foreach($consulta->archivos as $archivo) {
        if($archivo->arch_nom != null) {
          $archivos_a_eliminar[$cont2] = $archivo->arch_nom;
          $cont2 +=1;
        }
      }
    }
    // Se implementa esta forma de eliminar archivos ya que con la funcion "ArchivosEliminados::dispatch" no lo hace
    \Storage::disk('s3')->delete($archivos_a_eliminar);
  }
}