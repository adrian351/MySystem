<?php
namespace App\Repositories\venta\pedidoTerminado\armadoPedidoTerminado;
// Models
use App\Models\PedidoArmado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class ArmadoPedidoTerminadoRepositories implements ArmadoPedidoTerminadoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt             = $serviceCrypt;
  } 
  public function armadoFindOrFailById($id_armado, $relaciones) { // 'productos', 'direcciones', 'pedido'
    $id_armado = $this->serviceCrypt->decrypt($id_armado);
    $armado = PedidoArmado::with($relaciones)->findOrFail($id_armado);
    return $armado;
  }
}