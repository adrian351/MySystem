<?php
namespace App\Repositories\venta\pedidoTerminado;
// Models
use App\Models\Pedido;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class PedidoTerminadoRepositories implements PedidoTerminadoInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->papeleraDeReciclajeRepo  = $papeleraDeReciclajeRepositories;
  }
  public function pedidoTerminadoFindOrFailById($id_pedido, $relaciones) {
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    $pedido = Pedido::with($relaciones)
    ->where('estat_log', config('app.entregado'))
    ->findOrFail($id_pedido);
    return $pedido;
  }
  public function getPagination($request, $relaciones, $opc_consulta) {
    return Pedido::filtrosPedido($opc_consulta)
    ->with($relaciones)
    ->where('estat_log', config('app.entregado'))
    ->buscar($request->opcion_buscador, $request->buscador)
    ->orderBy('fech_estat_log', 'DESC')->paginate($request->paginador);
  }
  public function update($request, $id_pedido) {
    try { DB::beginTransaction();
      $pedido = $this->pedidoTerminadoFindOrFailById($id_pedido, []);
      $pedido->est              = $request->estatus;
      $pedido->tip              = $request->tipo;
      $pedido->coment_o_reclam  = $request->comentario_o_reclamacion;

      if($pedido->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Ventas (Pedidos Terminados)', // Módulo
          'venta.pedidoTerminado.show', // Nombre de la ruta
          $id_pedido, // Id del registro debe ir encriptado
          $pedido->num_pedido, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Estatus', 'Tipo', 'Comentario o reclamación'), // Nombre de los inputs del formulario
          $pedido, // Request
          array('est', 'tip', 'coment_o_reclam') // Nombre de los campos en la BD
        ); 
        $pedido->updated_at_ped  = Auth::user()->email_registro;
      }

      $pedido->save();

      DB::commit();
      return $pedido;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_pedido) {
    try { DB::beginTransaction();
      $pedido = $this->pedidoTerminadoFindOrFailById($id_pedido, []);
      $pedido->delete();
      // EN AUTOMATICO ELIMINA LA UNIFICACION QUE TIENE CON LOS DEMAS PEDIDOS

      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Ventas pedido terminado', // Nombre del módulo del sistema
        'registro'    => $pedido->num_pedido, // Información a mostrar en la papelera
        'tab'         => 'pedidos', // Nombre de la tabla en la BD
        'id_reg'      => $pedido->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación           
      ]);

      DB::commit();
      return $pedido;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}
