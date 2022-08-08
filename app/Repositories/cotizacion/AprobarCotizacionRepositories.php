<?php
namespace App\Repositories\cotizacion;
// Models
// use App\Models\Armado;
use App\Models\Cotizacion;
// Notifications
use App\Notifications\venta\pedidoActivo\NotificacionRegistrarPedido;
// Repositories
use App\Repositories\cotizacion\CotizacionRepositories;
use App\Repositories\sistema\serie\SerieRepositories;
use App\Repositories\usuario\UsuarioRepositories;
use App\Repositories\sistema\sistema\SistemaRepositories;
use App\Repositories\sistema\plantilla\PlantillaRepositories;
use App\Repositories\venta\pedidoActivo\armadoPedidoActivo\direccion\DireccionArmadoRepositories;
use App\Repositories\pago\PagoRepositories;
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;
use App\Repositories\produccion\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;
// Otro

use Illuminate\Support\Facades\Auth;
use DB;

class AprobarCotizacionRepositories implements AprobarCotizacionInterface {
  protected $cotizacionRepo;
  protected $serieRepo;
  protected $usuarioRepo;
  protected $sistemaRepo;
  protected $plantillaRepo;
  protected $direccionArmadoRepo;
  protected $pagoRepo;
  protected $ventaRepo;
  protected $producRepo;
  public function __construct(CotizacionRepositories $cotizacionRepositories, 
  SerieRepositories $serieRepositories, 
  UsuarioRepositories $usuarioRepositories, 
  SistemaRepositories $sistemaRepositories, 
  PlantillaRepositories $plantillaRepositories, 
  DireccionArmadoRepositories $direccionArmadoRepositories,
  PagoRepositories $pagoRepositories, 
  PedidoActivoRepositories $pedidoActivoRepositories,
  ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories
  ) {
    $this->cotizacionRepo       = $cotizacionRepositories;
    $this->serieRepo            = $serieRepositories;
    $this->usuarioRepo          = $usuarioRepositories;
    $this->sistemaRepo          = $sistemaRepositories;
    $this->plantillaRepo        = $plantillaRepositories;
    $this->direccionArmadoRepo  = $direccionArmadoRepositories;
    $this->pagoRepo             = $pagoRepositories;
    $this->ventaRepo            = $pedidoActivoRepositories;
    $this->producRepo           = $armadoPedidoActivoRepositories;
  } 
  public function elPedidoEsDeRegalo($cotizacion, $armados_cotizacion) {
    if($armados_cotizacion->where('es_de_regalo', 'Si')->sum('cant')  ==  $cotizacion->tot_arm ) {
      return 'Si';
    } else {
      return 'No';
    }
  }
  public function elPedidoTieneDireccionesForaneas($pedido, $armado_cotizacion, $modificado) {
    if($armado_cotizacion->direcciones->where('for_loc', 'Foráneo')->count() > 0) {// config('opcionesSelect.select_foraneo_local.Foráneo')
      $pedido->foraneo = 'Si';
      $pedido->save();
      $modificado = true;
    }
    return $modificado;
  }
  public function sumaUnoALaUltimaLetraYArmadosCargados($pedido, $cantidad) {
    $pedido->ult_let  = ++ $pedido->ult_let;
    $pedido->arm_carg += $cantidad;
    $pedido->save();
    return $pedido->num_pedido.'-'.$pedido->ult_let;
  }
  public function sumaUnoALaUltimaLetraDireccionesCargadas($armado) {
    $armado->ult_let  = ++ $armado->ult_let;
    $armado->save();
    return $armado->cod.'-'.$armado->ult_let;
  }

  // se aprueba una cotizacion
  public function aprobar($id_cotizacion) {
    try { DB::beginTransaction();
      $cotizacion = $this->cotizacionRepo->cotizacionAsignadoFindOrFailById($id_cotizacion, 'armados', config('app.abierta'));
      $armados_cotizacion = $cotizacion->armados()->with('productos', 'direcciones')->get();
      $nom_tabla = (new \App\Models\Producto())->getTable();
      $tabla_armados = (new \App\Models\Armado())->getTable();
      if($cotizacion->tot == 0 ) {
        return abort('404', 'La cotización seleccionada no puede convertirce en un pedido ya que el total es de $0.00');
      }
      //  una vez que la cotizacion es aprobada se CREA EL PEDIDO
      $pedido = new \App\Models\Pedido();
      $pedido->serie            = $this->sistemaRepo->datos('ser_pedidos');
      $pedido->num_pedido       = $this->serieRepo->sumaUnoALaUltimaSerie('Pedidos (Serie)', $this->sistemaRepo->datos('ser_pedidos'));
      $pedido->coment_vent      = $cotizacion->coment_vent;
      $pedido->estat_alm        = config('app.pendiente');
      $pedido->cot_gen          = $cotizacion->serie;
      $pedido->ult_let          = 'A';
      $pedido->user_id          = $cotizacion->user_id;
      $pedido->tot_de_arm       = $cotizacion->tot_arm;
      if($pedido->tot_de_arm >= 11){
        $pedido->bod              = 'Temas';
      }else{
        $pedido->bod              = 'Naucalpan';
      }
      $pedido->mont_tot_de_ped  = $cotizacion->tot;
      $pedido->gratis           = $this->elPedidoEsDeRegalo($cotizacion, $armados_cotizacion);
      $pedido->estat_vent_arm   = config('app.armados_cargados');
      $pedido->con_iva          = $cotizacion->con_iva;
      $pedido->asignado_ped     = Auth::user()->email_registro;
      $pedido->created_at_ped   = Auth::user()->email_registro;
      $pedido->save();

      $contador3              = 0;
      $up_stock_productos     = NULL;
      $up_vendidos_productos  = NULL;
      $ids                    = NULL;
      $direcciones            = NULL;
      $modificado             = null;
      // variables armados 
      $dis_stock_arm  = NULL;
      $ids_armado     = NULL;
      
      foreach($armados_cotizacion as $armado_cotizacion) {
        if($armado_cotizacion->cant != $armado_cotizacion->cant_direc_carg) {
          return abort(403, 'No se han registrado todas las direcciones al armado '.$armado_cotizacion->nom);
        }
        // se guardan los datos a los que se cotizo
        $armado_cotizacion->prec_cot       = $armado_cotizacion->prec_redond;
        $armado_cotizacion->sub_tot_cot    = $armado_cotizacion->sub_total;
        $armado_cotizacion->desc_cot       = $armado_cotizacion->desc;
        $armado_cotizacion->iva_cot        = $armado_cotizacion->iva;
        $armado_cotizacion->tot_cot        = $armado_cotizacion->tot;
        $armado_cotizacion->save();

        // preparara la consulta para disminuir el stock al los armados que son de stock
        $dis_stock_arm    .= ' WHEN '. $armado_cotizacion->id_armado. ' THEN stock-'. $armado_cotizacion->cant;
        $ids_armado .= $armado_cotizacion->id_armado.',';
        // REGISTRA LOS ARMADOS AL PEDIDO
        $armado_pedido               = new \App\Models\PedidoArmado();
        $armado_pedido->img_rut      = $armado_cotizacion->img_rut;
        $armado_pedido->img_nom      = $armado_cotizacion->img_nom;
        // DEFINE SI EL PEDIDO ES FORANEO O NO
          // if($modificado == null) {  $modificado = $this->elPedidoTieneDireccionesForaneas($pedido, $armado_cotizacion, $modificado);
          //   if($modificado == true) {$armado_pedido->for_loc    = config('opcionesSelect.select_foraneo_local.Foráneo');}
          // }

        // Se define si el pedido es foráneo o no y se le asigna el valor -for_loc a los armados
        foreach($armado_cotizacion->direcciones as $dir){
          if($modificado == null) {
            $modificado = $this->elPedidoTieneDireccionesForaneas($pedido, $armado_cotizacion, $modificado);
            }
          $armado_pedido->for_loc = $dir->for_loc;
        }
        $armado_pedido->cod          = $this->sumaUnoALaUltimaLetraYArmadosCargados($pedido, $armado_cotizacion->cant);
        $armado_pedido->id_armado    = $armado_cotizacion->id_armado;
        $armado_pedido->cant         = $armado_cotizacion->cant;
        $armado_pedido->tip          = $armado_cotizacion->tip;
        $armado_pedido->nom          = $armado_cotizacion->nom;
        $armado_pedido->sku          = $armado_cotizacion->sku;
        $armado_pedido->gama         = $armado_cotizacion->gama;
        $armado_pedido->prec         = $armado_cotizacion->prec_redond;
        $armado_pedido->tam          = $armado_cotizacion->tam;
        $armado_pedido->pes          = $armado_cotizacion->pes;
        $armado_pedido->alto         = $armado_cotizacion->alto;
        $armado_pedido->ancho        = $armado_cotizacion->ancho;
        $armado_pedido->largo        = $armado_cotizacion->largo;
        $armado_pedido->es_de_regalo = $armado_cotizacion->es_de_regalo;
        if($armado_cotizacion->es_de_regalo == 'Si') {
          $armado_pedido->aut   = config('app.pendiente');
        }
        $armado_pedido->es_de_stock = $armado_cotizacion->es_de_stock;
        //$armado_pedido->coment_vent  = $request->comentarios_ventas;
        $armado_pedido->pedido_id    = $pedido->id;
        $armado_pedido->created_at_ped_arm = Auth::user()->email_registro;
        $armado_pedido->save();
        
        if($armado_pedido->es_de_stock == 'Si'){
          if($dis_stock_arm != NULL) {
            $ids_armado = substr($ids_armado, 0, -1);
            DB::UPDATE("UPDATE ".$tabla_armados." SET stock = CASE id". $dis_stock_arm." END WHERE id IN (".$ids_armado.")");
          }
        }  
        $ids_armado   = NULL;
        $dis_stock_arm  = NULL;
      
        // REGISTRA LOS PRODUCTOS AL ARMADO
        foreach($armado_cotizacion->productos as $producto) {
          // PREPARA LA CONSULTA UPDATE MASIVA PARA DISMINUIR EL STOCK DEL PRODUCTO QUE TIENE EL ARMADO
            if($pedido->bod == 'Naucalpan'){
              $up_stock_productos     .= ' WHEN '. $producto->id_producto. ' THEN stock-'. $producto->cant * $armado_pedido->cant;
            }else if($pedido->bod == 'Temas'){
              $up_stock_productos     .= ' WHEN '. $producto->id_producto. ' THEN stock_temas-'. $producto->cant * $armado_pedido->cant;
            }
          $up_vendidos_productos  .= ' WHEN '. $producto->id_producto. ' THEN vend+'. $producto->cant * $armado_pedido->cant;
          $ids                    .= $producto->id_producto.',';
          // REGISTRA LOS PRODUCTOS AL ARMADO
          $productos_armado_ped = new \App\Models\PedidoArmadoTieneProducto();
          $productos_armado_ped->id_producto      = $producto->id_producto;
          $productos_armado_ped->cant             = $producto->cant;
          $productos_armado_ped->produc           = $producto->produc;
          $productos_armado_ped->sku              = $producto->sku;
          $productos_armado_ped->pedido_armado_id = $armado_pedido->id;
          $productos_armado_ped->created_at       = date("Y-m-d h:i:s");
          $productos_armado_ped->save();
          $productos_armado_ped->productos_original()->attach($producto->id_producto);
        }
        // disminuir el stock de armados
        // DISMINUYE EL STOCK DEL PRODUCTO QUE TIENE EL ARMADO
        if($armado_pedido->es_de_stock == 'No'){
          if($pedido->bod == 'Naucalpan'){
            if($up_stock_productos != NULL) {
              $ids = substr($ids, 0, -1);
              DB::UPDATE("UPDATE ".$nom_tabla." SET stock = CASE id". $up_stock_productos." END, vend = CASE id".$up_vendidos_productos." END WHERE id IN (".$ids.")");
            }
          }else if($pedido->bod == 'Temas'){
            if($up_stock_productos != NULL) {
              $ids = substr($ids, 0, -1);
              DB::UPDATE("UPDATE ".$nom_tabla." SET stock_temas = CASE id". $up_stock_productos." END, vend = CASE id".$up_vendidos_productos." END WHERE id IN (".$ids.")");
            }
          }
        }
        $up_stock_productos     = NULL;
        $up_vendidos_productos  = NULL;
        $ids = NULL;

        // REGISTRA LAS DIRECCIONES AL ARMADO
        foreach($armado_cotizacion->direcciones as $direccion) {
          // separar las direcciones si es que son de Tarífa única
          if($direccion->est != "Tarifa única (Varios estados)"){
            $direcciones[$contador3]['cod']                       = $this->sumaUnoALaUltimaLetraDireccionesCargadas($armado_pedido);
            $direcciones[$contador3]['cant']                      = $direccion->cant;
            $direcciones[$contador3]['tip_tarj_felic']            = 'Estandar';
            $direcciones[$contador3]['met_de_entreg']             = $direccion->met_de_entreg;

            // DEFINE EL NUEVO VALOR DEL ESTADO SIN LA CAMPITAL
            $nuevo_est = null;
            for($i = 0; $i <strlen($direccion->est); $i++) {
              if($direccion->est[$i] == '(') {
                break;
              }
              $nuevo_est .= $direccion->est[$i];
            }
            $direcciones[$contador3]['est']                       = $nuevo_est;
            $direcciones[$contador3]['for_loc']                   = $direccion->for_loc;
            $direcciones[$contador3]['detalles_de_la_ubicacion']  = $direccion->detalles_de_la_ubicacion;
            $direcciones[$contador3]['tip_env']                   = $direccion->tip_env;
            $direcciones[$contador3]['cost_por_env']              = $direccion->cost_por_env;

            if($direccion->cost_tam_caj > 0.00) {
              $direcciones[$contador3]['caj']              = 'Con caja ('.$direccion->tam.')';
            } else {
              $direcciones[$contador3]['caj']              = 'En canasta';
            }

            $direcciones[$contador3]['created_at_direc_arm']      = Auth::user()->email_registro;
            // Si el metodo de entrega es "Entregado en bodega" se llenara la demas informacion con la de la empresa
            if($direccion->met_de_entreg == 'Entregado en bodega naucalpan') {
              $direcciones[$contador3]['nom_ref_uno'] = 'Encargado de logística';
              $direcciones[$contador3]['lad_mov']     = '1';
              $direcciones[$contador3]['tel_mov']     = '00000000';
              $direcciones[$contador3]['calle']       = 'Blvrd Manuel Ávila Camacho';
              $direcciones[$contador3]['no_ext']      = '80';
              $direcciones[$contador3]['no_int']      = '204';
              $direcciones[$contador3]['pais']        = 'México';
              $direcciones[$contador3]['ciudad']      = 'Estado de México';
              $direcciones[$contador3]['col']         = 'El Parque';
              $direcciones[$contador3]['del_o_munic'] = 'Naucalpan de Juárez';
              $direcciones[$contador3]['cod_post']    = '53398';

              // ACTUALIZA EL ESTATUS DE LAS DIRECCIONES DEL PEDIDO
              $this->direccionArmadoRepo->estatusDireccionesDetalladas($direcciones[$contador3]['cant'], $armado_pedido, 'No');
            }elseif($direccion->met_de_entreg == 'Entregado en bodega temascalapa'){
              $direcciones[$contador3]['nom_ref_uno'] = 'Encargado de logística';
              $direcciones[$contador3]['lad_mov']     = '1';
              $direcciones[$contador3]['tel_mov']     = '00000000';
              $direcciones[$contador3]['calle']       = 'San Francisco';
              $direcciones[$contador3]['no_ext']      = '33';
              $direcciones[$contador3]['no_int']      = '';
              $direcciones[$contador3]['pais']        = 'México';
              $direcciones[$contador3]['ciudad']      = 'Estado de México';
              $direcciones[$contador3]['col']         = 'Barrio San Miguel';
              $direcciones[$contador3]['del_o_munic'] = 'Temascalapa';
              $direcciones[$contador3]['cod_post']    = '55980';

              $this->direccionArmadoRepo->estatusDireccionesDetalladas($direcciones[$contador3]['cant'], $armado_pedido, 'No');
            }else {
              $direcciones[$contador3]['nom_ref_uno'] = null;
              $direcciones[$contador3]['lad_mov']     = null;
              $direcciones[$contador3]['tel_mov']     = null;
              $direcciones[$contador3]['calle']       = null;
              $direcciones[$contador3]['no_ext']      = null;
              $direcciones[$contador3]['no_int']      = null;
              $direcciones[$contador3]['pais']        = null;
              $direcciones[$contador3]['ciudad']      = $nuevo_est;
              $direcciones[$contador3]['col']         = null;
              $direcciones[$contador3]['del_o_munic'] = null;
              $direcciones[$contador3]['cod_post']    = null;
            }

            $direcciones[$contador3]['pedido_armado_id']          = $armado_pedido->id;
            $direcciones[$contador3]['created_at']                = date("Y-m-d h:i:s");
            $contador3 +=1;
          }else {
            // SEPRARA LAS DIRECCIONES CUANDO SEAN DE TARIFA ÚNCA
            $nuevo_est = "Tarifa única";
            // calcular el costo de envio para tarifa única.
            $costoEnv = $direccion->cost_por_env / $direccion->cant;
            $cantidadDireccion = $direccion->cant;
            $num = 1;

            for($i = 0; $i < $cantidadDireccion; $i++) {
              $direcciones[$contador3]['est']                       = $nuevo_est;
              $direcciones[$contador3]['cod']                       = $this->sumaUnoALaUltimaLetraDireccionesCargadas($armado_pedido);
              $direcciones[$contador3]['cant']                      = $num;
              $direcciones[$contador3]['tip_tarj_felic']            = 'Estandar';
              $direcciones[$contador3]['met_de_entreg']             = $direccion->met_de_entreg;
              $direcciones[$contador3]['for_loc']                   = $direccion->for_loc;
              $direcciones[$contador3]['detalles_de_la_ubicacion']  = $direccion->detalles_de_la_ubicacion;
              $direcciones[$contador3]['tip_env']                   = $direccion->tip_env;
              $direcciones[$contador3]['cost_por_env']              = $costoEnv;
        
              if($direccion->cost_tam_caj > 0.00) {
                $direcciones[$contador3]['caj']              = 'Con caja ('.$direccion->tam.')';
              } else {
                $direcciones[$contador3]['caj']              = 'En canasta';
              }
        
              $direcciones[$contador3]['created_at_direc_arm']      = Auth::user()->email_registro;
              $direcciones[$contador3]['nom_ref_uno'] = null;
              $direcciones[$contador3]['lad_mov']     = null;
              $direcciones[$contador3]['tel_mov']     = null;
              $direcciones[$contador3]['calle']       = null;
              $direcciones[$contador3]['no_ext']      = null;
              $direcciones[$contador3]['no_int']      = null;
              $direcciones[$contador3]['pais']        = null;
              $direcciones[$contador3]['ciudad']      = $nuevo_est;
              $direcciones[$contador3]['col']         = null;
              $direcciones[$contador3]['del_o_munic'] = null;
              $direcciones[$contador3]['cod_post']    = null;
              $direcciones[$contador3]['pedido_armado_id']          = $armado_pedido->id;
              $direcciones[$contador3]['created_at']                = date("Y-m-d h:i:s");
              $contador3 +=1;
            }
          }
        }
      }
      if($direcciones != null) {
        \App\Models\PedidoArmadoTieneDireccion::insert($direcciones);
      }

      // CORREO ALTA DE PEDIDO
      $cliente    = $this->usuarioRepo->getUsuarioFindOrFail($pedido->user_id, []);
      $plantilla  = $this->plantillaRepo->plantillaFindOrFailById($this->sistemaRepo->datos('plant_vent_reg_ped'));
      // Envió de correo electrónico
      $cliente->notify(new NotificacionRegistrarPedido($cliente, $pedido, $plantilla)); 

      // CIERRA LA COTIZACIÓN
      $cotizacion->estat = config('app.aprobada');
      $cotizacion->num_pedido_gen = $pedido->num_pedido;
      $cotizacion->save();

      // SI CUMPLE CON LA CONFICION SE MODIFICA EL ESTATUS DE PRODUCCIÓN Y ALMACEN PARA QUE LO PUEDAN VISUALIZAR
      if($pedido->mont_tot_de_ped <= 25000) {
        $this->pagoRepo->modificarEstatusProduccionYAlmacen($pedido);
      }
      $this->ventaRepo->armadoEstatus($pedido);
      $this->producRepo->estatusArmadoDireccion($pedido);
      DB::commit();
      return (object) [
        'cotizacion'  => $cotizacion,
        'pedido'      => $pedido
      ];
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}