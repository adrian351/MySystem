<?php
namespace App\Repositories\venta\pedidoActivo\codigoQR;

class GenerarQRRepositories implements GenerarQRInterface {
  public function qr($id, $modulo, $otro = null) {
    $codigoQR = \QrCode::format('svg')
      ->size(100)
      ->margin(0)
      ->errorCorrection('H')
      ->generate(route('rastrea.pedido.rastrearPorQR', [$id, $modulo, $otro]));

      return $codigoQR;
  }
}