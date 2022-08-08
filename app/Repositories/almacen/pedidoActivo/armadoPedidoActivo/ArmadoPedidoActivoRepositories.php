<?php
namespace App\Repositories\almacen\pedidoActivo\armadoPedidoActivo;
// Models
use App\Models\Pedido;
use App\Models\PedidoArmado;
// Repositories
use App\Repositories\logistica\direccionLocal\DireccionLocalRepositories;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ArmadoPedidoActivoRepositories implements ArmadoPedidoActivoInterface {
  protected $serviceCrypt;
  protected $direccionLocalRepo;
  public function __construct(ServiceCrypt $serviceCrypt, DireccionLocalRepositories $direccionLocalRepositories) {
    $this->serviceCrypt = $serviceCrypt;
    $this->direccionLocalRepo = $direccionLocalRepositories;
  }
  public function armadoPedidoActivoFindOrFailById($id_armado, $relaciones, $accion) { // 'pedido'
    $id_armado = $this->serviceCrypt->decrypt($id_armado); 
    $consulta = PedidoArmado::with($relaciones);
    if($accion == 'edit') {
      $consulta->where(function ($query){
        $query->where('estat', config('app.en_espera_de_compra'))
          ->orWhere('estat', config('app.en_revision_de_productos'));
      });
    }
    return $consulta->findOrFail($id_armado);
  }
  public function update($request, $id_armado) {
    try { DB::beginTransaction();
      $armado = $this->armadoPedidoActivoFindOrFailById($id_armado, ['pedido'], 'edit');
      $armado->estat         = $request->estatus;

      if($armado->estat == config('app.en_almacen_de_salida')) {
        $armado->ubic_rack = 'Producto de STOCK';

        //Cambia es estatus de las direcciones relacionadas a este armado
        $this->direccionLocalRepo->cambiarEstatusDireccionAlmacenDeSalida($armado->direcciones);

        // Se guarda la fecha en la que el pedido paso a logística por primera vez
        if($armado->pedido->fech_estat_log == null) {
          $armado->pedido->fech_estat_log = date("Y-m-d h:i:s");
        }
        if($armado->pedido->lid_de_ped_produc == null) {
          $armado->pedido->lid_de_ped_produc = 'Producto de STOCK';
        }
        $armado->pedido->save();
      }

      $armado->coment_alm    = $request->comentario_almacen;
      if($armado->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Almacén/Pedidos activos (armado)', // Módulo
          'almacen.pedidoActivo.armado.show', // Nombre de la ruta
          $id_armado, // Id del registro debe ir encriptado
          $armado->cod, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Estatus', 'Comentario almacen'), // Nombre de los inputs del formulario
          $armado, // Request
          array('estat', 'coment_alm') // Nombre de los campos en la BD
        ); 
        $armado->updated_at_ped_arm = Auth::user()->email_registro;
      }
      $armado->save();
      Pedido::getEstatusPedido($armado->pedido, 'Todos');
      DB::commit();
      return $armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getArmadoPedidoTieneProductosPaginate($pedido, $request) {
    if($request->opcion_buscador != null) {
      return $pedido->productos()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $pedido->productos()->paginate($request->paginador);
  }
  public function armadosTerminadosAlmacen($id_pedido, $estatus) {
    return Pedido::armadosTerminados($id_pedido, $estatus);
  }
}