<?php
namespace App\Repositories\logistica\pedidoActivo\armadoPedidoActivo;
// Models
use App\Models\Pedido;
use App\Models\PedidoArmado;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ArmadoPedidoActivoRepositories implements ArmadoPedidoActivoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function armadoPedidoActivoFindOrFailById($id_armado, $relaciones, $accion) { // 'pedido'
    $id_armado = $this->serviceCrypt->decrypt($id_armado); 
    $consulta = PedidoArmado::with($relaciones);
    if($accion == 'edit') {
      $consulta->where(function ($query){
        $query->where('estat', config('app.en_almacen_de_salida'))
          ->orWhere('estat', config('app.sin_entrega_por_falta_de_informacion'))
          ->orWhere('estat', config('app.intento_de_entrega_fallido'));
      });
    }
    return $consulta->findOrFail($id_armado);
  }
  public function update($request, $id_armado) {
    try { DB::beginTransaction();
      $armado              = $this->armadoPedidoActivoFindOrFailById($id_armado, ['pedido'], 'edit');
      $armado->coment_log  = $request->comentario_armado;
      if($armado->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Logística/Pedidos activos (armado)', // Módulo
          'logistica.pedidoActivo.armado.show', // Nombre de la ruta
          $id_armado, // Id del registro debe ir encriptado
          $armado->cod, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Comentario armado'), // Nombre de los inputs del formulario
          $armado, // Request
          array('coment_log') // Nombre de los campos en la BD
        ); 
        $armado->updated_at_ped_arm = Auth::user()->email_registro;
      }
      $armado->save();

      DB::commit();
      return $armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function armadosTerminadosLogistica($id_pedido, $estatus) {
    return Pedido::armadosTerminados($id_pedido, $estatus);
  }
  public function getArmadoPedidoTieneDireccionesPaginate($pedido, $request) {
    if($request->opcion_buscador != null) {
      return $pedido->direcciones()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $pedido->direcciones()->paginate($request->paginador);
  }

  public function updateModal($request, $id_armado) {
    try { DB::beginTransaction();
      $armado                 = $this->armadoPedidoActivoFindOrFailById($id_armado, ['pedido', 'direcciones'], 'edit');
      $armado->estat          = config('app.en_almacen_de_salida');
      $armado->ubic_rack      = $request->ubicacion_rack;


      if($armado->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Logística/Pedidos activos (armado)', // Módulo
          'logistica.pedidoActivo.armado.show', // Nombre de la ruta
          $id_armado, // Id del registro debe ir encriptado
          $armado->cod, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Ubicación rack'), // Nombre de los inputs del formulario
          $armado, // Request
          array('ubic_rack') // Nombre de los campos en la BD
        ); 
        $armado->updated_at_ped_arm = Auth::user()->email_registro;
      }
      $armado->save();
      
      DB::commit();
      return $armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }

}