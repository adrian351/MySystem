<?php
namespace App\Repositories\logistica\direccionLocal;
// Models
use App\Models\PedidoArmadoTieneDireccion;
use App\Models\PedidoArmadoDireccionTieneComprobante;
// Notifications
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Notifications\logistica\NotificacionPedidoEntregado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\logistica\direccionLocal\EstatusArmadoRepositories;
use App\Repositories\metodoDeEntrega\MetodoDeEntregaEspecificoRepositories;
use App\Repositories\sistema\plantilla\PlantillaRepositories;
use App\Repositories\sistema\sistema\SistemaRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class DireccionLocalRepositories implements DireccionLocalInterface {
  protected $serviceCrypt;
  protected $estatusArmadoRepo;
  protected $metodoDeEntregaEspecificoRepo;
  protected $plantillaRepo;
  protected $sistemaRepo;
  public function __construct(ServiceCrypt $serviceCrypt, EstatusArmadoRepositories $estatusArmadoRepositories, MetodoDeEntregaEspecificoRepositories $metodoDeEntregaEspecificoRepositories, PlantillaRepositories $plantillaRepositories, SistemaRepositories $sistemaRepositories) {
    $this->serviceCrypt                   = $serviceCrypt;
    $this->estatusArmadoRepo              = $estatusArmadoRepositories;
    $this->metodoDeEntregaEspecificoRepo  = $metodoDeEntregaEspecificoRepositories;
    $this->plantillaRepo                  = $plantillaRepositories;
    $this->sistemaRepo                    = $sistemaRepositories;
  }
  public function direccionLocalFindOrFailById($id_direccion, $for_loc, $relaciones, $accion, $regresado) {
    $id_direccion = $this->serviceCrypt->decrypt($id_direccion);
    $direccion = PedidoArmadoTieneDireccion::with($relaciones);
    
    if($for_loc != null) {
      $direccion->where('for_loc', $for_loc);
    }
    if($regresado == true OR $accion == 'edit') {
      $direccion->where('regresado', 'Falso');
    }
    if($accion == 'edit') {
      $direccion->where(function ($query) {
        $query->where('estat', config('app.en_almacen_de_salida'))
        ->orWhere('estat', config('app.en_ruta'))
        ->orWhere('estat', config('app.sin_entrega_por_falta_de_informacion'))
        ->orWhere('estat', config('app.intento_de_entrega_fallido'));
      });
    }
    return $direccion->findOrFail($id_direccion);
  }
  public function getPagination($request, $for_loc, $relaciones) {
    if($request->paginador == null) {
      $paginador = 50;
    }else {
      $paginador = $request->paginador;
    }

    return PedidoArmadoTieneDireccion::with($relaciones)
    ->with(['armado'=> function ($query) {
      $query->select('id', 'cod', 'pedido_id')->with(['pedido'=> function ($query) {
        $query->select('id', 'fech_de_entreg', 'estat_pag', 'bod');
      }]);
    }])
    ->where('for_loc', $for_loc)
    ->where(function ($query) {
      $query->where('estat', config('app.pendiente'))
      ->orWhere('estat', config('app.en_almacen_de_salida'))
        ->orWhere('estat', config('app.en_ruta'))
        ->orWhere('estat', config('app.sin_entrega_por_falta_de_informacion'))
        ->orWhere('estat', config('app.intento_de_entrega_fallido'));
      })
    ->buscar($request->opcion_buscador, $request->buscador)
    ->orderBy('fech_en_alm_salida', 'DESC')
    ->paginate($paginador);
  }
  public function store($request, $id_direccion) {
    try { DB::beginTransaction();
      $direccion                            = $this->direccionLocalFindOrFailById($this->serviceCrypt->encrypt($id_direccion), null, ['armado'], 'edit', null);
      $metodo_de_entrega_especifico         = $this->metodoDeEntregaEspecificoRepo->metodoEspecificoFirstByNombreMetodo($request->metodo_de_entrega_especifico, []);
      if($metodo_de_entrega_especifico == null) {
        $url = null;
      }else {
        $url = $metodo_de_entrega_especifico->url;
      }
      $direccion->estat                     = config('app.en_ruta');
      $direccion->met_de_entreg_de_log      = $request->metodo_de_entrega;
      $direccion->met_de_entreg_de_log_esp  = $request->metodo_de_entrega_especifico;
      $direccion->url                       = $url;
      $direccion->cost_por_env_log          = $request->costo_por_envio;
      $direccion->created_com_sal           = Auth::user()->email_registro;
      $direccion->fech_car_comp_de_sal      = date('Y-m-d h:i:s');

      if($request->hasfile('comprobante_de_salida')) {
        $comprobante_de_salida        = $request->file('comprobante_de_salida');
        $direccion->comp_de_sal_rut   = env('PREFIX');
        \Storage::disk('s3')->delete($direccion->comp_de_sal_nom);   //aqui no se sabe si tiene o no
        $nombre_archivo = \Storage::disk('s3')->put('pedidos/'.date("Y").'/comprobante/direc-'.$direccion->id, $comprobante_de_salida, 'public');
        $direccion->comp_de_sal_nom   = $nombre_archivo;
      }
      $direccion->save();

      $this->estatusArmadoRepo->estatusArmado($direccion);

      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function storeEntrega($request, $id_direccion) {
    try { DB::beginTransaction();
      $direccion        = $this->direccionLocalFindOrFailById($this->serviceCrypt->encrypt($id_direccion), null, ['armado', 'comprobantes'], 'edit', null);
      $direccion->estat = $request->metodo_de_entrega_especifico;
      $direccion->estat = config('app.entregado');
      $direccion->save();

      $this->estatusArmadoRepo->estatusArmado($direccion);
    
      if(!$direccion->comprobantes->isEmpty()) {
        $comprobante = PedidoArmadoDireccionTieneComprobante::find($direccion->comprobantes[0]->id);
        $comprobante->updated_at_comp = Auth::user()->email_registro;
      } else {
        $comprobante = new PedidoArmadoDireccionTieneComprobante();
        $comprobante->created_at_comp = Auth::user()->email_registro;
      }

      $comprobante->paq             = $request->paqueteria;
      $comprobante->num_guia        = $request->numero_de_guia;
      $comprobante->direccion_id    = $id_direccion;
      
      
      // GUARDA LA IMAGEN DEL COMRPBANTE
      if($request->hasfile('comprobante_de_entrega')) {
        $comprobante_de_entrega        = $request->file('comprobante_de_entrega');
        $comprobante->comp_ent_rut       = env('PREFIX');
        // \Storage::disk('s3')->delete($comprobante->comp_ent_nom);
        if($comprobante->comp_ent_nom == 'imagenes_estaticas/SIN-IMAGEN.jpg' || $comprobante->comp_ent_nom == null || $comprobante->comp_ent_nom == ''){

        }else{
           \Storage::disk('s3')->delete($comprobante->comp_ent_nom);
        }
         //aqui no sabemos si hay o no imagen 
        $nombre_archivo = \Storage::disk('s3')->put('pedidos/'.date("Y").'/comprobante/direc-'.$direccion->id, $comprobante_de_entrega, 'public');
        $comprobante->comp_ent_nom   = $nombre_archivo;
      }
      
      $comprobante->save();
       
      $cliente = $direccion->armado->pedido->usuario;
      $plantilla = $this->plantillaRepo->plantillaFindOrFailById($this->sistemaRepo->datos('plant_ped_ent'));
      $cliente->notify(new NotificacionPedidoEntregado($cliente, $plantilla, $direccion->armado->cod)); // Envió de correo electrónico

      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function update($request, $id_direccion, $loc_for) {
    try { DB::beginTransaction();
      $direccion        = $this->direccionLocalFindOrFailById($id_direccion, null, ['armado'], 'show', true);
      if($request->estatus == config('app.sin_entrega_por_falta_de_informacion') OR $request->estatus == config('app.intento_de_entrega_fallido')) {
        $direccion->estat = $request->estatus;
        $direccion->coment_estatus = $request->comentario_estatus;

        if($direccion->isDirty()) {
          if($loc_for == config('opcionesSelect.select_foraneo_local.Local')) {
            $modulo = 'Direccion local';
            $nom_ruta = 'logistica.direccionLocal.show';
          }elseif($loc_for == config('opcionesSelect.select_foraneo_local.Foráneo')) {
            $modulo = 'Direccion fonarea';
            $nom_ruta = 'logistica.direccionForaneo.show';
          }
            
          // Dispara el evento registrado en App\Providers\EventServiceProvider.php
          ActividadRegistrada::dispatch(
            $modulo, // Módulo
            $nom_ruta, // Nombre de la ruta
            $id_direccion, // Id del registro debe ir encriptado
            $direccion->armado->cod, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
            array('Estatus', 'comentario_estatus'), // Nombre de los inputs del formulario
            $direccion, // Request
            array('estat', 'coment_estatus') // Nombre de los campos en la BD
          ); 
          $direccion->updated_at_direc_arm  = Auth::user()->email_registro;
        }

        $direccion->save();
        $this->estatusArmadoRepo->estatusArmado($direccion);
      } else {
        $this->estatusArmadoRepo->regresarAProduccion($direccion->armado);
        $direccion->coment_estatus = $request->comentario_estatus;
      }
      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function cambiarEstatusDireccionAlmacenDeSalida($direcciones) {
    $fecha = date('Y-m-d h:i:s');
    $up_fecha = null;
    $up_estaus     = NULL;
    $up_regresados = null;
    $ids           = NULL;
    $nom_tabla = (new PedidoArmadoTieneDireccion())->getTable();

    foreach($direcciones as $direccion) {
      if($direccion->estat == config('app.pendiente')) {
        $up_estaus  .= ' WHEN '. $direccion->id. ' THEN "'. config('app.en_almacen_de_salida').'"';
        $up_fecha   .= ' WHEN '. $direccion->id. ' THEN "'.  $fecha.'"';
        $ids        .= $direccion->id.',';
      } else {
        $up_regresados  .= ' WHEN '. $direccion->id. ' THEN "Falso"';
        $ids        .= $direccion->id.',';
      }
    }

    if($up_estaus != NULL) {
      $ids = substr($ids, 0, -1);
      DB::UPDATE("UPDATE ".$nom_tabla." SET estat = CASE id". $up_estaus." END, fech_en_alm_salida = CASE id". $up_fecha." END WHERE id IN (".$ids.")");
    }
    if($up_regresados != NULL) {
      $ids = substr($ids, 0, -1);
      DB::UPDATE("UPDATE ".$nom_tabla." SET regresado = CASE id". $up_regresados." END WHERE id IN (".$ids.")");
    }
  }
}