<?php
namespace App\Http\Controllers\RolCliente\Pedido\Armado;
use App\Http\Controllers\Controller;
//Models
use App\Models\PedidoArmado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;

class ArmadoController extends Controller {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  } 
  public function show($id_armado) {
    $id_armado = $this->serviceCrypt->decrypt($id_armado);
    $armado       = PedidoArmado::with(['productos', 'direcciones', 'pedido'])->findOrFail($id_armado);
    $pedido       = $armado->pedido()->firstOrFail();

    // Aborta si el armado que pertene al pedido no es del cliente 
    if($pedido->user_id != Auth::user()->id) {
      abort('404');
    }

    $productos    = $armado->productos()->with(['sustitutos', 'productos_original'])->get();
    $direcciones  = $armado->direcciones()->paginate(99999999);
    return view('rolCliente.pedido.armado.arm_show', compact('armado', 'pedido', 'productos', 'direcciones'));
  }
}