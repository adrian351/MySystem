<?php
namespace App\Repositories\almacen\pedidoActivo;
// Models
use App\Models\Pedido;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class PedidoActivoRepositories implements PedidoActivoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function pedidoActivoAlmacenFindOrFailById($id_pedido, $relaciones) {
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    $pedido = Pedido::with($relaciones)->where(function ($query){
                $query->where('estat_alm', config('app.asignar_persona_que_recibe'))
                    ->orWhere('estat_alm', config('app.en_espera_de_ventas'))
                    ->orWhere('estat_alm', config('app.en_espera_de_compra'))
                    ->orWhere('estat_alm', config('app.en_revision_de_productos'));
                })->findOrFail($id_pedido);
    return $pedido;
  }
  public function getPagination($request, $relaciones, $opc_consulta) {
    if($request->paginador == null) {
      $paginador = 50;
    }else {
      $paginador = $request->paginador;
    }

    return Pedido::pendientesPedido($opc_consulta)
                ->with($relaciones)
                ->where('estat_alm', '!=', config('app.productos_completos_terminado'))
                /*
                ->where(function ($query){
                $query->where('estat_alm', config('app.asignar_persona_que_recibe'))
                    ->orWhere('estat_alm', config('app.en_espera_de_ventas'))
                    ->orWhere('estat_alm', config('app.en_espera_de_compra'))
                    ->orWhere('estat_alm', config('app.en_revision_de_productos'));
                })
                */
                ->buscar($request->opcion_buscador, $request->buscador)
                ->orderBy('fech_estat_alm', 'DESC')
                ->paginate($paginador);
  }
  public function update($request, $id_pedido) {
    try { DB::beginTransaction();
      $id_pedido = $this->serviceCrypt->encrypt($id_pedido);
      $pedido                 = $this->pedidoActivoAlmacenFindOrFailById($id_pedido, []);
      $pedido->per_reci_alm   = $request->persona_que_recibe;
      $pedido->coment_alm     = $request->comentario_almacen;
      if($pedido->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Almacén (Pedidos activos)', // Módulo
          'almacen.pedidoActivo.show', // Nombre de la ruta
          $id_pedido, // Id del registro debe ir encriptado
          $pedido->num_pedido, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Persona que recibe', 'Comentario almacén'), // Nombre de los inputs del formulario
          $pedido, // Request
          array('per_reci_alm', 'coment_alm') // Nombre de los campos en la BD
        );
        $pedido->updated_at_ped = Auth::user()->email_registro;
      }
      if($request->checkbox_imagen == 'on') {
        if($request->hasfile('imagen')) {
          $imagen        = $request->file('imagen');
          \Storage::disk('s3')->delete($pedido->img_firm);
          $nombre_archivo = \Storage::disk('s3')->put('pedidos/'.date("Y").'/'.$pedido->num_pedido.'/firma', $imagen, 'public');
          $pedido->img_firm_rut  = env('PREFIX');
          $pedido->img_firm      = $nombre_archivo;
        }
      }

      $pedido->save();
      Pedido::getEstatusPedido($pedido, 'Todos');
      DB::commit();
      return $pedido;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getArmadosPedidoPaginate($pedido, $request) {
    if($request->opcion_buscador != null) {
      return $pedido->armados()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $pedido->armados()->paginate($request->paginador);
  }
  public function marcarTodoCompleto($id_pedido) {
    // CAMBIA EL ESTATUS LOS ARMADOS CON LOS ESTATUS ESPESIFICADOS Y AL FINAL CAMBIA EL ESTATUS (ALMACÉN) DEL PEDIDO
    try { DB::beginTransaction();
      $pedido = $this->pedidoActivoAlmacenFindOrFailById($id_pedido, ['armados']);

      $armados = $pedido->armados()->where('estat', config('app.en_espera_de_compra'))
                        ->orWhere('estat', config('app.en_revision_de_productos'))
                        ->get();
     
      $nom_tabla = (new \App\Models\PedidoArmado())->getTable();

      $hastaC                 = count($armados);
      $up_estatus_armado      = null;
      $up_updated_at_ped_arm  = null;
      $up_updated_at          = null;
      $ids                    = null;
      // se cambia el estatus de los armados en la tabla pedido_armados a productos completos
      foreach($armados as $armado) {
        $up_estatus_armado      .= ' WHEN '. $armado->id. ' THEN "'. config('app.productos_completos'). '"';
        $up_updated_at_ped_arm  .= ' WHEN '. $armado->id. ' THEN "'. Auth::user()->email_registro.'"';
        $up_updated_at          .= ' WHEN '. $armado->id. ' THEN "'.date('Y-m-d h:i:s').'"';
        $ids                    .= $armado->id.',';
      }

      if($hastaC > 0) {
        $ids = substr($ids, 0, -1);
        DB::UPDATE("UPDATE ".$nom_tabla." SET estat = CASE id". $up_estatus_armado." END, updated_at_ped_arm = CASE id". $up_updated_at_ped_arm." END, updated_at = CASE id". $up_updated_at." END WHERE id IN (".$ids.")");
      }

      Pedido::getEstatusPedido($pedido, 'Todos');
      DB::commit();
      return $pedido;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getPendientes() {
    // obtiene la cantidad de los pedidos pendientes
    $fecha = date("Y-m-d");
    $mas_dia = date("Y-m-d", strtotime('+3 day', strtotime(date("Y-m-d"))));
    $menos_un_dia = date("Y-m-d", strtotime('-1 day', strtotime(date("Y-m-d"))));
    $menos_dia = date("Y-m-d", strtotime('-5 day', strtotime(date("Y-m-d"))));
    $nom_tabla = (new \App\Models\Pedido())->getTable();
    
    $consulta = DB::table('pedidos')->select(
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_alm = '".config('app.asignar_persona_que_recibe')."' OR estat_alm = '".config('app.en_espera_de_ventas')."' OR estat_alm = '".config('app.en_espera_de_compra')."' OR estat_alm = '".config('app.en_revision_de_productos')."') AND (fech_de_entreg BETWEEN '$fecha' AND '$mas_dia')) as porEntregar"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_alm = '".config('app.asignar_persona_que_recibe')."' OR estat_alm = '".config('app.en_espera_de_ventas')."' OR estat_alm = '".config('app.en_espera_de_compra')."' OR estat_alm = '".config('app.en_revision_de_productos')."') AND (fech_de_entreg BETWEEN '$menos_dia' AND '$menos_un_dia')) as yaCaducados"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_alm = '".config('app.asignar_persona_que_recibe')."' OR estat_alm = '".config('app.en_espera_de_ventas')."' OR estat_alm = '".config('app.en_espera_de_compra')."' OR estat_alm = '".config('app.en_revision_de_productos')."') AND (estat_pag != '".config('app.pagado')."')) as pteDePago"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_alm = '".config('app.asignar_persona_que_recibe')."' OR estat_alm = '".config('app.en_espera_de_ventas')."' OR estat_alm = '".config('app.en_espera_de_compra')."' OR estat_alm = '".config('app.en_revision_de_productos')."') AND (estat_pag = '".config('app.pago_rechazado')."')) as pagoRechazado"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_alm = '".config('app.asignar_persona_que_recibe')."' OR estat_alm = '".config('app.en_espera_de_ventas')."' OR estat_alm = '".config('app.en_espera_de_compra')."' OR estat_alm = '".config('app.en_revision_de_productos')."') AND (estat_vent_gen != '".config('app.falta_informacion_general')."' OR estat_vent_dir != '".config('app.falta_detallar_direccion')."')) as pteDeInformacion"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_alm = '".config('app.asignar_persona_que_recibe')."' OR estat_alm = '".config('app.en_espera_de_ventas')."' OR estat_alm = '".config('app.en_espera_de_compra')."' OR estat_alm = '".config('app.en_revision_de_productos')."') AND (estat_log = '".config('app.sin_entrega_por_falta_de_informacion')."')) as sinEntregaPorFaltaDeInformacion"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_alm = '".config('app.asignar_persona_que_recibe')."' OR estat_alm = '".config('app.en_espera_de_ventas')."' OR estat_alm = '".config('app.en_espera_de_compra')."' OR estat_alm = '".config('app.en_revision_de_productos')."') AND (estat_log = '".config('app.intento_de_entrega_fallido')."')) as intentoDeEntregaFallido"),
      DB::raw("(SELECT count(*) FROM $nom_tabla WHERE (estat_alm = '".config('app.asignar_persona_que_recibe')."' OR estat_alm = '".config('app.en_espera_de_ventas')."' OR estat_alm = '".config('app.en_espera_de_compra')."' OR estat_alm = '".config('app.en_revision_de_productos')."') AND (urg = '".config('opcionesSelect.es_pedido_urgente.Si')."')) as urgente")
    )->first();
    if($consulta == null) { 
      $consulta = (object) array('porEntregar' => 0, 'yaCaducados' => 0, 'pteDePago' => 0, 'pagoRechazado' => 0, 'pteDeInformacion' => 0, 'sinEntregaPorFaltaDeInformacion' => 0, 'intentoDeEntregaFallido' => 0, 'urgente' => 0);
    }

    return $consulta; 
  }
  public function getAllPedidosPlunk() {
    return Pedido::where(function ($query){
                $query->where('estat_alm', config('app.asignar_persona_que_recibe'))
                    ->orWhere('estat_alm', config('app.en_espera_de_ventas'))
                    ->orWhere('estat_alm', config('app.en_espera_de_compra'))
                    ->orWhere('estat_alm', config('app.en_revision_de_productos'));
                })
                ->orderBy('fech_estat_alm', 'DESC')
                ->pluck('num_pedido', 'id');
  }
}