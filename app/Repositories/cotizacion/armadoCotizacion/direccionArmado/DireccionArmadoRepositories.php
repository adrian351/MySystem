<?php
namespace App\Repositories\cotizacion\armadoCotizacion\direccionArmado;
// Models
use App\Models\CotizacionArmadoTieneDirecciones;
// Events
use App\Events\layouts\ActividadRegistrada;
// Repositories
use App\Repositories\cotizacion\CotizacionRepositories;
use App\Repositories\cotizacion\CalcularValoresCotizacionRepositories;
use App\Repositories\cotizacion\armadoCotizacion\ArmadoCotizacionRepositories;
use App\Repositories\cotizacion\armadoCotizacion\CalcularValoresArmadoCotizacionRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class DireccionArmadoRepositories implements DireccionArmadoInterface {
  protected $serviceCrypt;
  protected $cotizacionRepo;
  protected $calcularValoresCotizacionRepo;
  protected $armadoCotizacionRepo;
  protected $calcularValoresArmadoCotizacionRepo;
  public function __construct(ServiceCrypt $serviceCrypt, CotizacionRepositories $cotizacionRepositories, CalcularValoresCotizacionRepositories $calcularValoresCotizacionRepositories, ArmadoCotizacionRepositories $armadoCotizacionRepositories, CalcularValoresArmadoCotizacionRepositories $calcularValoresArmadoCotizacionRepositories) {
    $this->serviceCrypt                         = $serviceCrypt;
    $this->cotizacionRepo                       = $cotizacionRepositories;
    $this->calcularValoresCotizacionRepo        = $calcularValoresCotizacionRepositories;
    $this->armadoCotizacionRepo                 = $armadoCotizacionRepositories;
    $this->calcularValoresArmadoCotizacionRepo  = $calcularValoresArmadoCotizacionRepositories;
  }
  public function direccionFindOrFailById($id_direccion) {
    $id_direccion = $this->serviceCrypt->decrypt($id_direccion);
    $direccion = CotizacionArmadoTieneDirecciones::with('armado')->findOrFail($id_direccion);
    return $direccion;
  }
  public function store($request, $id_armado) {
    try { DB::beginTransaction();
      $armado     = $this->armadoCotizacionRepo->armadoFindOrFailById($this->serviceCrypt->encrypt($id_armado), 'cotizacion');
      $this->armadoCotizacionRepo->verificarElEstatusDeLaCotizacion($armado->cotizacion->estat);
      $cotizacion = $armado->cotizacion;

      // GUARDA LA DIRECCIÓN AL ARMADO
      $direccion = new CotizacionArmadoTieneDirecciones();
      $direccion->for_loc                   = $request->costo_seleccionado['for_loc'];
      $direccion->met_de_entreg             = $request->costo_seleccionado['met_de_entreg'];
      $direccion->met_de_entreg_esp         = $request->costo_seleccionado['met_de_entreg_esp'];
      $direccion->cantt                     = $request->costo_seleccionado['cant'];
      $direccion->trans                     = $request->costo_seleccionado['trans'];
      $direccion->est                       = $request->costo_seleccionado['est'];
      $direccion->tot_unit                  = $request->costo_seleccionado['tot_unit'];
      $direccion->mun                       = $request->costo_seleccionado['mun'];
      $direccion->tip_env                   = $request->costo_seleccionado['tip_env'];
      $direccion->tam                       = $request->costo_seleccionado['tam'];
      $direccion->cost_tam_caj              = $request->costo_seleccionado['cost_tam_caj'];
      $direccion->seg                       = $request->costo_seleccionado['seg'];
      $direccion->tiemp_ent                 = $request->costo_seleccionado['tiemp_ent'];
      $direccion->cost_por_env_individual   = $request->costo_seleccionado['cost_por_env'];


      if($direccion->est == 'Ciudad de México (Ciudad de México)' OR  $direccion->est == 'México (Edo. México)') {
        if($direccion->tot_unit == 'Total') {
          $direccion->cost_por_env = $request->costo_seleccionado['cost_por_env'];
        } else if($direccion->tot_unit == 'Unitario') {
          $direccion->cost_por_env = $request->costo_seleccionado['cost_por_env'] *  $request->cantidad;
        }
      }elseif($direccion->tip_env == 'Consolidado' or $direccion->tip_env == 'Directo') {
        $direccion->cost_por_env              = $request->costo_seleccionado['cost_por_env'];
      } else {
        $direccion->cost_por_env              = $request->costo_seleccionado['cost_por_env'] *  $request->cantidad;
      }

      if($request->costo_seleccionado['cost_tam_caj'] > 0) {
        $direccion->cost_por_env += $request->costo_seleccionado['cost_tam_caj'] *  $request->cantidad;
      }

      $direccion->cant                      = $request->cantidad;
      // $direccion->detalles_de_la_ubicacion  = $request->detalles_de_la_ubicacion;
      if ($request['detalles_de_la_ubicacion'] != null || $request['detalles_de_la_ubicacion'] != '') {
        $direccion->detalles_de_la_ubicacion = $request['detalles_de_la_ubicacion'];
        }else{
            $direccion->detalles_de_la_ubicacion = 'Sin detalles';
          }
      
      $direccion->armado_id                 = $id_armado;
      $direccion->created_at_dir            = Auth::user()->email_registro;
      $direccion->save();
      
      // GENERA LOS NUEVOS VALORES PARA EL ARMADO
      $armado->cost_env         += $direccion->cost_por_env;
      $armado->cant_direc_carg  += $direccion->cant;
      $armado                   = $this->calcularValoresArmadoCotizacionRepo->sumaValoresArmadoCotizacion($armado);
      $armado->save();

      // GENERA LOS NUEVOS PRECIOS DE LA COTIZACIÓN
      $this->calcularValoresCotizacionRepo->calculaValoresCotizacion($cotizacion);
      $cotizacion->save();

      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function update($request, $id_direccion) {
    try { DB::beginTransaction();
      $direccion  = $this->direccionFindOrFailById($this->serviceCrypt->encrypt($id_direccion));
      $armado     = $direccion->armado()->with('cotizacion')->first();
      $this->armadoCotizacionRepo->verificarElEstatusDeLaCotizacion($armado->cotizacion->estat);

      $cant_direc_orig                      = $direccion->cant;
      $cost_por_env_vent_orig               = $direccion->cost_por_env;

      if($request->costo_seleccionado != []) {
        $direccion->for_loc                   = $request->costo_seleccionado['for_loc'];
        $direccion->met_de_entreg             = $request->costo_seleccionado['met_de_entreg'];
        $direccion->met_de_entreg_esp         = $request->costo_seleccionado['met_de_entreg_esp'];
        $direccion->cantt                     = $request->costo_seleccionado['cant'];
        $direccion->trans                     = $request->costo_seleccionado['trans'];
        $direccion->est                       = $request->costo_seleccionado['est'];
        $direccion->tot_unit                  = $request->costo_seleccionado['tot_unit'];
        $direccion->mun                       = $request->costo_seleccionado['mun'];
        $direccion->tip_env                   = $request->costo_seleccionado['tip_env'];
        $direccion->tam                       = $request->costo_seleccionado['tam'];
        $direccion->cost_tam_caj              = $request->costo_seleccionado['cost_tam_caj'];
        $direccion->seg                       = $request->costo_seleccionado['seg'];
        $direccion->tiemp_ent                 = $request->costo_seleccionado['tiemp_ent'];
        $direccion->cost_por_env_individual   = $request->costo_seleccionado['cost_por_env'];

        if($direccion->est == 'Ciudad de México (Ciudad de México)' OR  $direccion->est == 'México (Edo. México)') {
          if($direccion->tot_unit == 'Total') {
            $direccion->cost_por_env = $request->costo_seleccionado['cost_por_env'];
          } else if($direccion->tot_unit == 'Unitario') {
            $direccion->cost_por_env = $request->costo_seleccionado['cost_por_env'] *  $request->cantidad;
          }
        }elseif($direccion->tip_env == 'Consolidado' or $direccion->tip_env == 'Directo') {
          $direccion->cost_por_env              = $request->costo_seleccionado['cost_por_env'];
        } else {
          $direccion->cost_por_env              = $request->costo_seleccionado['cost_por_env'] *  $request->cantidad;
        }

        if($request->costo_seleccionado['cost_tam_caj'] > 0) {
          $direccion->cost_por_env += $request->costo_seleccionado['cost_tam_caj'] *  $request->cantidad;
        }
      } else {
        if($direccion->est == 'Ciudad de México (Ciudad de México)' OR  $direccion->est == 'México (Edo. México)') {
          if($direccion->tot_unit == 'Total') {
            $direccion->cost_por_env = $direccion->cost_por_env_individual;
          } else if($direccion->tot_unit == 'Unitario') {
            $direccion->cost_por_env = $direccion->cost_por_env_individual * $request->cantidad;
          }
        }elseif($direccion->tip_env == 'Consolidado' or $direccion->tip_env == 'Directo') {
          $direccion->cost_por_env = $direccion->cost_por_env_individual;
        } else {
          $direccion->cost_por_env = $direccion->cost_por_env_individual * $request->cantidad;
        }

        if($direccion->cost_tam_caj > 0) {
          $direccion->cost_por_env += $direccion->cost_tam_caj *  $request->cantidad;
        }
      }

      $direccion->cant                      = $request->cantidad;
      $direccion->detalles_de_la_ubicacion  = $request->detalles_de_la_ubicacion;
      
      if($direccion->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Direcciones cotizaciones', // Módulo
          'cotizacion.armado.show', // Nombre de la ruta
          $this->serviceCrypt->encrypt($direccion->armado_id), // Id del registro debe ir encriptado
          $id_direccion, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Foráneo o local', 'Método de entrega', 'Método de entrega especifico', 'Cantidad', 'Transporte', 'Estado al que se cotizó', 'Total o unitario', 'Municipio', 'Tipo de envío', 'Tamaño', 'Costo de caja', 'Cuenta con seguro', 'Tiempo de entrega (Dias)', 'Costo de envío individual', 'Costo de envío', 'Cantidad', 'Detalles de la ubicación'), // Nombre de los inputs del formulario
          $direccion, // Request
          array(
            'for_loc', 'met_de_entreg', 'met_de_entreg_esp', 'cantt', 'trans', 'est', 'tot_unit', 'mun', 'tip_env', 'tam', 'cost_tam_caj', 'seg', 'tiemp_ent', 'cost_por_env_individual', 'cost_por_env', 'cant', 'detalles_de_la_ubicacion') // Nombre de los campos en la BD
        ); 
        $direccion->updated_at_dir  = Auth::user()->email_registro;
      }      
      $direccion->save();

      // ACTUALIZA Y GENERA LOS NUEVOS PRECIOS DEL ARMADO
      $armado->cost_env        -= $cost_por_env_vent_orig;
      $armado->cost_env        += $direccion->cost_por_env;
      $armado->cant_direc_carg -= $cant_direc_orig;
      $armado->cant_direc_carg += $direccion->cant;
      $armado                   = $this->calcularValoresArmadoCotizacionRepo->sumaValoresArmadoCotizacion($armado);
      $armado->save();

      // GENERA LOS NUEVOS PRECIOS DE LA COTIZACIÓN
      $this->calcularValoresCotizacionRepo->calculaValoresCotizacion($armado->cotizacion);

      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_direccion) {
    try { DB::beginTransaction();
      $direccion  = $this->direccionFindOrFailById($id_direccion);
      $armado     = $direccion->armado()->with('cotizacion')->first();
      $this->armadoCotizacionRepo->verificarElEstatusDeLaCotizacion($armado->cotizacion->estat);
      $direccion->forceDelete();

      // ACTUALIZA Y GENERA LOS NUEVOS PRECIOS DEL ARMADO
      $armado->cost_env        -= $direccion->cost_por_env;
      $armado->cant_direc_carg -= $direccion->cant;
      $armado                   = $this->calcularValoresArmadoCotizacionRepo->sumaValoresArmadoCotizacion($armado);
      $armado->save();

      // GENERA LOS NUEVOS PRECIOS DE LA COTIZACIÓN
      $this->calcularValoresCotizacionRepo->calculaValoresCotizacion($armado->cotizacion);

      // IMPORTANTE NO SE IMPLEMENTARA PAPELERA DE RECICLAJE (POR LOS PRECIOS DE LOS ARMADOS RELACIONADOS A LA COTIZACIÓN)
      
      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}