<?php
namespace App\Repositories\venta\pedidoActivo\codigoQR;

interface GenerarQRInterface {
  public function qr($id, $modulo, $otro = null);
}