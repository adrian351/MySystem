<?php
namespace App\Repositories\rolCliente\pedido;
// Models
use App\Models\Pedido;
// Repositories
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Events
use App\Events\layouts\ActividadRegistrada;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class PedidoClienteRepositories implements PedidoClienteInterface {
  protected $serviceCrypt;
  protected $pedidoActivoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PedidoActivoRepositories $pedidoActivoRepositories) {
    $this->serviceCrypt     = $serviceCrypt;
    $this->pedidoActivoRepo = $pedidoActivoRepositories;
  }
  public function getPedidoFindOrFailById($id_pedido, $relaciones, $estatus) {
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    return Pedido::with($relaciones)->where('user_id', Auth::user()->id)->estatus($estatus)->findOrFail($id_pedido);
  }
  public function getPagination($request) {
    return Pedido::where('user_id', Auth::user()->id)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function update($request, $id_pedido) {
    // dd($request);
    try { DB::beginTransaction();
      $pedido = $this->getPedidoFindOrFailById($id_pedido, ['armados'], config('app.entregado'));
      // if($pedido->fech_de_entreg != null) {
      //   return abort('404', 'Ya se estableció esta información con anterioridad.');
      // }
      // $pedido->fech_de_entreg     = $request->fecha_de_entrega;
      // $pedido->se_pued_entreg_ant = $request->se_puede_entregar_antes;
      // if($pedido->se_pued_entreg_ant == 'Si') {
      //   $pedido->cuant_dia_ant    = $request->cuantos_dias_antes;
      // } elseif($pedido->se_pued_entreg_ant == 'No') {
      //   $pedido->cuant_dia_ant    = null;
      // }
      $pedido->coment_client      = $request->comentarios;
      if($pedido->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Pedidos (Cliente)', // Módulo
          'rolCliente.pedido.show', // Nombre de la ruta
          $id_pedido, // Id del registro debe ir encriptado
          $pedido->num_pedido, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Comentarios'), // Nombre de los inputs del formulario
          // 'Fecha de entrega', '¿Se puede entregar antes?', '¿Cuántos días antes?', 
          $pedido, // Request
          array( 'coment_client') // Nombre de los campos en la BD
          // 'fech_de_entreg', 'se_pued_entreg_ant', 'cuant_dia_ant',
        ); 
        $pedido->updated_at_ped  = Auth::user()->email_registro;
      }
      $fecha_original = $pedido->getOriginal('fech_de_entreg');
      $fecha_nueva    = $pedido->getAttribute('fech_de_entreg');
      $pedido->save();
      Pedido::getEstatusVentas($pedido);
      $this->pedidoActivoRepo->unificarPedido($pedido, $fecha_original, $fecha_nueva);
      DB::commit();
      return $pedido;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getPedidosSinPagarClientePluck() {
    return Pedido::where('user_id', Auth::user()->id)->where('estat_pag', '!=', config('app.pagado'))->orderBy('num_pedido', 'ASC')->pluck('num_pedido', 'id');
  }
  public function getArmadosPedidoPagination($pedido, $request) {
    if($request->opcion_buscador != null) {
      return $pedido->armados()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $pedido->armados()->paginate($request->paginador);
  }
  public function getFaltanteDePago($id_pedido) {
    $id_pedido = $this->serviceCrypt->encrypt($id_pedido);
    $pedido = $this->getPedidoFindOrFailById($id_pedido, ['pagos'], null);




    $sum_mont_de_pag = $pedido->pagos()->sum('mont_de_pag');
    $max_monto = $pedido->mont_tot_de_ped - $sum_mont_de_pag;
    return $max_monto;


  }
}