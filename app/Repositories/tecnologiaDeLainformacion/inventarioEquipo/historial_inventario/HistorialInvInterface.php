<?php
namespace App\Repositories\tecnologiaDeLainformacion\inventarioEquipo\historial_inventario;

interface HistorialInvInterface {
  public function historialFindOrFailById($id_historial);
}