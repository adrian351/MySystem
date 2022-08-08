<?php
namespace App\Repositories\venta\pedidoActivo\armadoPedidoActivo;
// Models
use App\Models\PedidoArmado;
use App\Models\PedidoArmadoTieneDireccion;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// repositories
use App\Repositories\venta\pedidoActivo\armadoPedidoActivo\direccion\DireccionArmadoRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ArmadoPedidoActivoRepositories implements ArmadoPedidoActivoInterface {
  protected $serviceCrypt;
  protected $direccionArmadoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, DireccionArmadoRepositories $direccionArmadoRepositories) { 
    $this->serviceCrypt             = $serviceCrypt;
    $this->direccionArmadoRepo      = $direccionArmadoRepositories; 
  } 
  public function armadoFindOrFailById($id_armado, $relaciones) { // 'productos', 'direcciones', 'pedido'
    $id_armado = $this->serviceCrypt->decrypt($id_armado);
    $armado = PedidoArmado::with($relaciones)->findOrFail($id_armado);
    return $armado;
  }
  public function update($request, $id_armado) {
    try { DB::beginTransaction();
      $armado = $this->armadoFindOrFailById($id_armado, []);
      $armado->coment_vent  = $request->comentarios_adicionales;

      if($armado->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Ventas/Pedidos activos (armados)', // Módulo
          'venta.pedidoActivo.armado.show', // Nombre de la ruta
          $id_armado, // Id del registro debe ir encriptado
          $armado->cod, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Comentarios adicionales'), // Nombre de los inputs del formulario
          $armado, // Request
          array('coment_vent') // Nombre de los campos en la BD
        ); 
        $armado->updated_at_ped_arm  = Auth::user()->email_registro;
      }

      $armado->save();
      DB::commit();
      return $armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }

  public function updateDirecciones($request, $id_armado){
    try { DB::beginTransaction();
      $armado = $this->armadoFindOrFailById($id_armado, ['direcciones']);
      $direcciones = $armado->direcciones()->where('nom_ref_uno', null)->get();
      $cantDirecciones = count($direcciones);
      $direccion_excel = 'Direccion en excel';
      
      $nom_tabla_direcciones = (new PedidoArmadoTieneDireccion())->getTable();
      $nom_ref_uno  = NULL;
      $nom_ref_dos  = NULL;
      $tel_mov      = NULL;
      $calle        = NULL;
      $no_ext       = NULL;
      $no_int       = NULL;
      $pais         = NULL;
      $ciudad       = NULL;
      $col          = NULL;
      $del_o_munic  = NULL;
      $cod_post     = NULL;
      $ref_zon_de_entreg = NULL;
      $updated_at_direc_arm   =  NULL;
      $ids_direc = NULL;
        
      foreach($direcciones as $direccion){ 
        $nom_ref_uno  .= ' WHEN '. $direccion->id. ' THEN "'. $direccion_excel.'"';
        $nom_ref_dos  .= ' WHEN '. $direccion->id. ' THEN "'. $direccion_excel.'"';
        $tel_mov      .= ' WHEN '. $direccion->id. ' THEN "'. '0000000000'.'"';
        $calle        .= ' WHEN '. $direccion->id. ' THEN "'. $direccion_excel.'"';
        $no_ext       .= ' WHEN '. $direccion->id. ' THEN "'. '000'.'"';
        $no_int       .= ' WHEN '. $direccion->id. ' THEN "'. '000'.'"';
        $pais         .= ' WHEN '. $direccion->id. ' THEN "'. 'México'.'"';
        $ciudad       .= ' WHEN '. $direccion->id. ' THEN "'. $direccion_excel.'"';
        $col          .= ' WHEN '. $direccion->id. ' THEN "'. $direccion_excel.'"';
        $del_o_munic  .= ' WHEN '. $direccion->id. ' THEN "'. $direccion_excel.'"';
        $cod_post     .= ' WHEN '. $direccion->id. ' THEN "'. '0000'.'"';
        $ref_zon_de_entreg .= ' WHEN '. $direccion->id. ' THEN "'. $direccion_excel.'"';
        $updated_at_direc_arm   .=  ' WHEN '. $direccion->id. ' THEN "'. Auth::user()->email_registro.'"';
        $ids_direc        .= $direccion->id.',';
      }
          
      if($cantDirecciones > 0) {
        $ids_direc = substr($ids_direc, 0, -1);
        DB::UPDATE("UPDATE ".$nom_tabla_direcciones." SET nom_ref_uno = CASE id". $nom_ref_uno." END, 
          nom_ref_dos = CASE id". $nom_ref_dos." END,
          tel_mov = CASE id". $tel_mov." END,
          calle = CASE id". $calle." END,
          no_ext = CASE id". $no_ext." END,
          no_int = CASE id". $no_int." END,
          pais = CASE id". $pais." END,
           ciudad = CASE id". $ciudad." END,
          col = CASE id". $col." END,
          del_o_munic = CASE id". $del_o_munic." END,
          cod_post = CASE id". $cod_post." END,
          ref_zon_de_entreg = CASE id". $ref_zon_de_entreg." END,
          updated_at_direc_arm = CASE id". $updated_at_direc_arm." END WHERE id IN (".$ids_direc.")"
        );
      }
      
      $armado->save();
      foreach($direcciones as $direccion){
        $this->direccionArmadoRepo->estatusDireccionesDetalladas($direccion->cant, $direccion->armado, 'No');
      }
    
      DB::commit();
      return $armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }

  public function dividirDireccion($request, $id_armado){
    
    try { DB::beginTransaction();
      $armado = $this->armadoFindOrFailById($id_armado, ['direcciones']);
      $direccion = $armado->direcciones()->where('id', $request->id_direccion)->firstOrFail();

      $codigo = NULL;
      // obtener el ultimo codigo de la lsita de direcciones del armado
      $array_direcciones = $armado->direcciones;
      $cod_ultimo = $array_direcciones[0];
      // destructuracion del codigo de la dirección
      $codigo = $cod_ultimo->cod;
      $coddigo_destruc = explode("-", $codigo);
      // obtener las partes del codigo que no cambian (CYA-num_pedido-letra) y convertirlo a un string
      $cod_texto_destruc = array_slice($coddigo_destruc, 0, 3);
      $cod_text = implode('-', $cod_texto_destruc);
      // obtener la parte del codigo que cambiará (numero) y aumentarlo.
      $cod_num_des = $coddigo_destruc[3];
      $cod_num = ++ $cod_num_des;
      // $costo_total = $direccion->cost_por_env;
      $costo_individual =  $direccion->cost_por_env / $direccion->cant;
      if($request->div_todo == 'on'){
        for($i = 0; $i < $direccion->cant -1; $i++){

          $direccion_nueva = new  \App\Models\PedidoArmadoTieneDireccion();
          $direccion_nueva->cod                 = $cod_text.'-'.$cod_num_des++;
          $direccion_nueva->rut                 = $direccion->rut;
          $direccion_nueva->regresado           = $direccion->regresado;
          $direccion_nueva->coment_estatus      = $direccion->coment_estatus;
          $direccion_nueva->cant                = 1;
          $direccion_nueva->estat               = $direccion->estat;
          $direccion_nueva->tip_tarj_felic      = $direccion->tip_tarj_felic;
          $direccion_nueva->mens_dedic          = $direccion->mens_dedic;              
          $direccion_nueva->tarj_dise_rut       = $direccion->tarj_dise_rut;
          $direccion_nueva->tarj_dise_nom       = $direccion->tarj_dise_nom;
          $direccion_nueva->met_de_entreg       = $direccion->met_de_entreg;
          $direccion_nueva->fech_en_alm_salida  = $direccion->fech_en_alm_salida;
          $direccion_nueva->est                 = $direccion->est;
          $direccion_nueva->for_loc             = $direccion->for_loc;
          $direccion_nueva->detalles_de_la_ubicacion = $direccion->detalles_de_la_ubicacion;
          $direccion_nueva->tip_env             = $direccion->tip_env;
          $direccion_nueva->cost_por_env        = $costo_individual;
          $direccion_nueva->caj                 = $direccion->caj;
          $direccion_nueva->created_com_sal     = $direccion->created_com_sal;
          $direccion_nueva->fech_car_comp_de_sal  = $direccion->fech_car_comp_de_sal;
          $direccion_nueva->met_de_entreg_de_log  = $direccion->met_de_entreg_de_log;
          $direccion_nueva->met_de_entreg_de_log_esp = $direccion->met_de_entreg_de_log_esp;
          $direccion_nueva->comp_de_sal_rut     = $direccion->comp_de_sal_rut;
          $direccion_nueva->comp_de_sal_nom     = $direccion->comp_de_sal_nom;
          $direccion_nueva->url                 = $direccion->url;
          $direccion_nueva->cost_por_env_log    = $direccion->cost_por_env_log;
          $direccion_nueva->nom_ref_uno         = $direccion->nom_ref_uno;
          $direccion_nueva->nom_ref_dos         = $direccion->nom_ref_dos;
          $direccion_nueva->lad_fij             = $direccion->lad_fij;
          $direccion_nueva->tel_fij             = $direccion->tel_fij;
          $direccion_nueva->ext                 = $direccion->ext;
          $direccion_nueva->lad_mov             = $direccion->lad_mov;
          $direccion_nueva->tel_mov             = $direccion->tel_mov;
          $direccion_nueva->calle               = $direccion->calle;
          $direccion_nueva->no_ext              = $direccion->no_ext;
          $direccion_nueva->no_int              = $direccion->no_int;
          $direccion_nueva->pais                = $direccion->pais;
          $direccion_nueva->ciudad              = $direccion->ciudad;
          $direccion_nueva->col                 = $direccion->col;
          $direccion_nueva->del_o_munic         = $direccion->del_o_munic;
          $direccion_nueva->cod_post            = $direccion->cod_post;
          $direccion_nueva->ref_zon_de_entreg   = $direccion->ref_zon_de_entreg;
          $direccion_nueva->pedido_armado_id    = $direccion->pedido_armado_id;
          $direccion_nueva->created_at_direc_arm = Auth::user()->email_registro;
          $direccion_nueva->updated_at_direc_arm = Auth::user()->email_registro;
          $direccion_nueva->created_at          = date("Y-m-d h:i:s");
          $direccion_nueva->updated_at          = date("Y-m-d h:i:s");
          $direccion_nueva->save();
         
        }
        $direccion->cant = 1;
        $direccion->cost_por_env = $costo_individual;
        $direccion->save();

        $armado->ult_let = $cod_num_des -1;
        $armado->save();

      }else{
        
        $direccion_nueva = new  \App\Models\PedidoArmadoTieneDireccion();
        $direccion_nueva->cod                 = $cod_text.'-'.$cod_num;
        $direccion_nueva->rut                 = $direccion->rut;
        $direccion_nueva->regresado           = $direccion->regresado;
        $direccion_nueva->coment_estatus      = $direccion->coment_estatus;
        $direccion_nueva->cant                = $request->cant_div;
        $direccion_nueva->estat               = $direccion->estat;
        $direccion_nueva->tip_tarj_felic      = $direccion->tip_tarj_felic;
        $direccion_nueva->mens_dedic          = $direccion->mens_dedic;              
        $direccion_nueva->tarj_dise_rut       = $direccion->tarj_dise_rut;
        $direccion_nueva->tarj_dise_nom       = $direccion->tarj_dise_nom;
        $direccion_nueva->met_de_entreg       = $direccion->met_de_entreg;
        $direccion_nueva->fech_en_alm_salida  = $direccion->fech_en_alm_salida;
        $direccion_nueva->est                 = $direccion->est;
        $direccion_nueva->for_loc             = $direccion->for_loc;
        $direccion_nueva->detalles_de_la_ubicacion = $direccion->detalles_de_la_ubicacion;
        $direccion_nueva->tip_env             = $direccion->tip_env;
        $direccion_nueva->cost_por_env        = $costo_individual * $direccion_nueva->cant;
        $direccion_nueva->caj                 = $direccion->caj;
        $direccion_nueva->created_com_sal     = $direccion->created_com_sal;
        $direccion_nueva->fech_car_comp_de_sal  = $direccion->fech_car_comp_de_sal;
        $direccion_nueva->met_de_entreg_de_log  = $direccion->met_de_entreg_de_log;
        $direccion_nueva->met_de_entreg_de_log_esp = $direccion->met_de_entreg_de_log_esp;
        $direccion_nueva->comp_de_sal_rut     = $direccion->comp_de_sal_rut;
        $direccion_nueva->comp_de_sal_nom     = $direccion->comp_de_sal_nom;
        $direccion_nueva->url                 = $direccion->url;
        $direccion_nueva->cost_por_env_log    = $direccion->cost_por_env_log;
        $direccion_nueva->nom_ref_uno         = $direccion->nom_ref_uno;
        $direccion_nueva->nom_ref_dos         = $direccion->nom_ref_dos;
        $direccion_nueva->lad_fij             = $direccion->lad_fij;
        $direccion_nueva->tel_fij             = $direccion->tel_fij;
        $direccion_nueva->ext                 = $direccion->ext;
        $direccion_nueva->lad_mov             = $direccion->lad_mov;
        $direccion_nueva->tel_mov             = $direccion->tel_mov;
        $direccion_nueva->calle               = $direccion->calle;
        $direccion_nueva->no_ext              = $direccion->no_ext;
        $direccion_nueva->no_int              = $direccion->no_int;
        $direccion_nueva->pais                = $direccion->pais;
        $direccion_nueva->ciudad              = $direccion->ciudad;
        $direccion_nueva->col                 = $direccion->col;
        $direccion_nueva->del_o_munic         = $direccion->del_o_munic;
        $direccion_nueva->cod_post            = $direccion->cod_post;
        $direccion_nueva->ref_zon_de_entreg   = $direccion->ref_zon_de_entreg;
        $direccion_nueva->pedido_armado_id    = $direccion->pedido_armado_id;
        $direccion_nueva->created_at_direc_arm = Auth::user()->email_registro;
        $direccion_nueva->updated_at_direc_arm = Auth::user()->email_registro;
        $direccion_nueva->created_at          = date("Y-m-d h:i:s");
        $direccion_nueva->updated_at          = date("Y-m-d h:i:s");
        $direccion_nueva->save();
      
        $nueva_cant = $direccion->cant - $request->cant_div;
        $direccion->cant = $nueva_cant;
        $direccion->cost_por_env = $costo_individual * $direccion->cant;
        $direccion->save();

        $armado->ult_let = $cod_num;
        $armado->save();
      }
      
      DB::commit();
      return $armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; } 
  }
}