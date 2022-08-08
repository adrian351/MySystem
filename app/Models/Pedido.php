<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use DB;

class Pedido extends Model{
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table='pedidos';
  protected $primaryKey='id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
  protected $softCascade = ['archivos', 'armados', 'pagos']; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  // Define si vera todos los registros de la tabla o solo los que se le asignaron o los que usuario registro (on = todos los registros null = solo sus registros)
  public function scopeAsignado($query, $opcion_asignado, $usuario) {
    if($opcion_asignado == null) {
      return $query->where('asignado_ped', $usuario);
    }
  }
  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
  public function scopeEstatus($query, $estatus) {
    if($estatus != null) {
      return $query->where('estat_log', '!=', $estatus);
    }
  }
  // Rastrear
  public function scopeRastrear($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", $buscador);
    } else {
      return $query->where('id', '!"#$%&/()(/&%$');
    }
  }  
  public function scopeFiltrosPedido($query, $opc_consulta) {
    switch($opc_consulta) {
      case 'comentarioReclamacion':
        return $query->where('tip', '!=', null);
    }
  }
  public function scopePendientesPedido($query, $opc_consulta) {
    $fecha = date("Y-m-d");
    $mas_dia = date("Y-m-d", strtotime('+3 day', strtotime(date("Y-m-d"))));
    $menos_un_dia = date("Y-m-d", strtotime('-1 day', strtotime(date("Y-m-d"))));
    $menos_dia = date("Y-m-d", strtotime('-5 day', strtotime(date("Y-m-d"))));

    switch($opc_consulta) {
      case 'porEntregar':
        return $query->whereBetween('fech_de_entreg', [$fecha, $mas_dia]);
      case 'yaCaducados':
        return $query->whereBetween('fech_de_entreg', [$menos_dia, $menos_un_dia]);
      case 'pteDePago':
        return $query->where('estat_pag', '!=', config('app.pagado'));
      case 'pagoRechazado':
        return $query->where('estat_pag', config('app.pago_rechazado'));
      case 'pteDeInformacion':
        return $query->where('estat_vent_gen', '!=', config('app.falta_informacion_general'))
                      ->orwhere('estat_vent_dir', '!=', config('app.falta_detallar_direccion'));
      case 'sinEntregaPorFaltaDeInformacion':
        return $query->where('estat_log', config('app.sin_entrega_por_falta_de_informacion'));
      case 'intentoDeEntregaFallido':
        return $query->where('estat_log', config('app.intento_de_entrega_fallido'));
      case 'urgente':
        return $query->where('urg', config('opcionesSelect.es_pedido_urgente.Si'));
    }
  }
  public function usuario() {
    return $this->belongsTo('App\User', 'user_id')->orderBy('id','DESC');
  }
  public function unificar() {
    return $this->belongsToMany('App\Models\Pedido', 'pedidos_unificados', 'pedido_id', 'unificado_id')->withPivot('id')->withTimestamps()->orderBy('pedidos_unificados.id', 'DESC');
  }
  public function armados() {
    return $this->hasMany('App\Models\PedidoArmado', 'pedido_id')->orderBy('id', 'DESC');
  }  
  public function pagos() {
    return $this->hasMany('App\Models\Pago')->orderBy('id', 'DESC');
  }
  public function archivos() {
    return $this->hasMany('App\Models\PedidoTieneArchivos', 'pedido_id')->orderBy('id', 'DESC');
  } 
  
  public static function armadosTerminados($id_pedido, $estatus) {
    return PedidoArmado::where(function ($query) use($estatus) {
      $hastaC = count($estatus) -1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        $query->orWhere('estat', $estatus[$contador2]);
      }
    })->where('pedido_id', $id_pedido)->sum('cant');
  }
  public static function getEstatusVentas($pedido) {
    $direcciones_cargadas = $pedido->armados()->where('pedido_armados.estat','!=', config('app.cancelado'))->sum('cant_direc_carg');
 
    // ESTATUS GENERAL
    if($pedido->fech_de_entreg != null) {
      $pedido->estat_vent_gen = config('app.informacion_general_completa');
    } elseif($pedido->fech_de_entreg == null) {
      $pedido->estat_vent_gen = config('app.falta_informacion_general');
    }

    // ESTATUS ARMADOS
    if($pedido->arm_carg != $pedido->tot_de_arm) {
      $pedido->estat_vent_arm = config('app.falta_cargar_armados');
    } elseif($pedido->arm_carg == $pedido->tot_de_arm) {
      $pedido->estat_vent_arm = config('app.armados_cargados');
    }

    // ESTATUS DIRECCIONES ARMADOS
    if($direcciones_cargadas != $pedido->tot_de_arm) {
      $pedido->estat_vent_dir = config('app.falta_asignar_direcciones_armados');
    } elseif($direcciones_cargadas == $pedido->tot_de_arm) {
      $pedido->estat_vent_dir = config('app.direccion_de_armados_asignado');
    }
    $pedido->save();
    return $pedido;
  }
  public static function getEstatusPedido($pedido, $modulo) {
    $consulta = DB::table('pedido_armados')->select(
      // ESTATUS VENTAS
      DB::raw("(SELECT COUNT(*) FROM pedido_armados WHERE pedido_id = '$pedido->id' AND estat = '".config('app.pendiente')."') as pendiente"),
      // ESTATUS AlMACÉN
      DB::raw("(SELECT COUNT(*) FROM pedido_armados WHERE pedido_id = '$pedido->id' AND estat = '".config('app.en_espera_de_compra')."') as en_espera_de_compra"),
      DB::raw("(SELECT COUNT(*) FROM pedido_armados WHERE pedido_id = '$pedido->id' AND estat = '".config('app.en_revision_de_productos')."') as en_revision_de_productos"),
      // ESTATUS PRODUCCIÓN
      DB::raw("(SELECT COUNT(*) FROM pedido_armados WHERE pedido_id = '$pedido->id' AND estat = '".config('app.productos_completos')."') as productos_completos"),
      DB::raw("(SELECT COUNT(*) FROM pedido_armados WHERE pedido_id = '$pedido->id' AND estat = '".config('app.en_produccion')."') as en_produccion"),
      // ESTATUS ESTATUS LOGÍSTICA
      DB::raw("(SELECT COUNT(*) FROM pedido_armados WHERE pedido_id = '$pedido->id' AND estat = '".config('app.en_almacen_de_salida')."') as en_almacen_de_salida"),
      DB::raw("(SELECT COUNT(*) FROM pedido_armados WHERE pedido_id = '$pedido->id' AND estat = '".config('app.en_ruta')."') as en_ruta"),
      DB::raw("(SELECT SUM(cant) FROM pedido_armados WHERE pedido_id = '$pedido->id' AND estat = '".config('app.entregado')."') as suma_entregado"),
      DB::raw("(SELECT COUNT(*) FROM pedido_armados WHERE pedido_id = '$pedido->id' AND estat = '".config('app.sin_entrega_por_falta_de_informacion')."') as sin_entrega_por_falta_de_informacion"),
      DB::raw("(SELECT COUNT(*) FROM pedido_armados WHERE pedido_id = '$pedido->id' AND estat = '".config('app.intento_de_entrega_fallido')."') as intento_de_entrega_fallido"),
    )->first();

    if($modulo == 'Almacén' OR $modulo == 'Todos' AND $pedido->fech_estat_alm != null) {
      $pedido->estat_alm = Pedido::getEstatusAlmacen($consulta, $pedido->tot_de_arm, $pedido->arm_carg, $pedido->per_reci_alm);
    }
    if($modulo == 'Producción' OR $modulo == 'Todos' AND $pedido->fech_estat_produc != null) {
      $pedido->estat_produc = Pedido::getEstatusProduccion($consulta, $pedido->tot_de_arm, $pedido->arm_carg, $pedido->lid_de_ped_produc);
    }
    if($modulo == 'Logística' OR $modulo == 'Todos' AND $pedido->fech_estat_log != null) {
      $pedido->estat_log = Pedido::getEstatusLogistica($consulta, $pedido->tot_de_arm, $pedido->arm_carg);
    }
    //$estatus = [$pedido->estat_alm,$pedido->estat_produc,$pedido->estat_log,$pedido];
    $pedido->save();
  }
  public static function getEstatusAlmacen($consulta, $tot_de_arm, $arm_carg, $per_reci_alm) {
    $anteriores = $consulta->pendiente;

    if($tot_de_arm != $arm_carg) {
      $estat_alm = config('app.en_espera_de_ventas');
    }
    if($tot_de_arm == $arm_carg) {
      $estat_alm = config('app.productos_completos_terminado');
    }
    if($per_reci_alm == NULL) {
      $estat_alm = config('app.asignar_persona_que_recibe');
    }
    if($consulta->en_revision_de_productos > 0) {
      $estat_alm = config('app.en_revision_de_productos');
    }
    if($consulta->en_espera_de_compra > 0) {
      $estat_alm = config('app.en_espera_de_compra');
    }
    if($anteriores > 0 AND $consulta->en_espera_de_compra == 0 AND $consulta->en_revision_de_productos == 0) {
      $estat_alm = config('app.en_espera_de_ventas');
    }
    if(empty($estat_alm)) {
      return abort(500, 'Algo salio mal en el estatus de almacén');
    }
    return $estat_alm;
  }
  public static function getEstatusProduccion($consulta, $tot_de_arm, $arm_carg, $lid_de_ped_produc) {
    $anteriores = $consulta->pendiente + $consulta->en_espera_de_compra + $consulta->en_revision_de_productos;

    if($tot_de_arm != $arm_carg) {
      $estat_produc = config('app.en_espera_de_almacen');
    }
    if($lid_de_ped_produc != NULL AND $tot_de_arm == $arm_carg) {
      $estat_produc = config('app.en_almacen_de_salida_terminado');
    }
    if($lid_de_ped_produc != NULL AND $consulta->en_produccion > 0) {
      $estat_produc = config('app.en_produccion');
    }
    if($lid_de_ped_produc != NULL AND $consulta->productos_completos > 0) {
      $estat_produc = config('app.productos_completos');
    }
    if($lid_de_ped_produc != NULL AND $anteriores > 0 AND $consulta->productos_completos == 0 AND $consulta->en_produccion == 0) {
      $estat_produc = config('app.en_espera_de_almacen');
    }
    if($lid_de_ped_produc == NULL) {
      $estat_produc = config('app.asignar_lider_de_pedido');
    }
    if(empty($estat_produc)) {
      return abort(500, 'Algo salio mal en el estatus de producción');
    }
    return $estat_produc;
  }
  public static function getEstatusLogistica($consulta, $tot_de_arm, $arm_carg) {
    $anteriores = $consulta->pendiente + $consulta->en_espera_de_compra + $consulta->en_revision_de_productos + $consulta->productos_completos + $consulta->en_produccion;
    
    if($tot_de_arm != $arm_carg) {
      $estat_log = config('app.en_espera_de_produccion');
    }
    if($anteriores == 0 AND $consulta->suma_entregado == $tot_de_arm) {
      $estat_log = config('app.entregado');
    }
    if($consulta->en_ruta > 0) {
      $estat_log = config('app.en_ruta');
    }
    if($consulta->en_almacen_de_salida > 0) {
      $estat_log = config('app.en_almacen_de_salida');
    }
    if($consulta->intento_de_entrega_fallido > 0) {
      $estat_log = config('app.intento_de_entrega_fallido');
    }
    if($consulta->sin_entrega_por_falta_de_informacion > 0) {
      $estat_log = config('app.sin_entrega_por_falta_de_informacion');
    }
    if($anteriores > 0  AND $consulta->sin_entrega_por_falta_de_informacion == 0 AND $consulta->intento_de_entrega_fallido == 0 AND $consulta->en_almacen_de_salida == 0 AND $consulta->en_ruta == 0) {
      $estat_log = config('app.en_espera_de_produccion');
    }
    if(empty($estat_log)) {
      return abort(500, 'Algo salio mal en el estatus de logística');
    }
    return $estat_log;
  }
}