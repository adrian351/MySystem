<?php
namespace App\Repositories\costoDeEnvio;
// Models
use App\Models\CostoDeEnvio;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class CostoDeEnvioRepositories implements CostoDeEnvioInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt               = $serviceCrypt;
    $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
  } 
  public function costoDeEnvioAsignadoFindOrFailById($id_costo) {
    $id_costo = $this->serviceCrypt->decrypt($id_costo);
    $costo_de_envio = CostoDeEnvio::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->findOrFail($id_costo);
    return $costo_de_envio;
  }
  public function getPagination($request) {
    return CostoDeEnvio::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try { DB::beginTransaction();
      $costo_de_envio                     = new CostoDeEnvio();
      $costo_de_envio->for_loc            = $request->foraneo_o_local;
      $costo_de_envio->met_de_entreg      = $request->metodo_de_entrega;
      $costo_de_envio->met_de_entreg_esp  = $request->metodo_de_entrega_especifico;
      $costo_de_envio->cant               = $request->cantidad;
      $costo_de_envio->trans              = $request->transporte;
      $costo_de_envio->est                = $request->estado;
      $costo_de_envio->tot_unit           = $request->total_o_unitario;
      $costo_de_envio->mun                = $request->municipio;
      $costo_de_envio->tip_env            = $request->tipo_de_envio;
      $costo_de_envio->tam                = $request->tamano;
      $costo_de_envio->aplic_cos_caj      = $request->aplicar_costo_de_caja;
      $costo_de_envio->registr            = $request->foraneo_o_local.$request->metodo_de_entrega.$request->metodo_de_entrega_especifico.$request->cantidad.$request->transporte.$request->estado.$request->total_o_unitario.$request->municipio.$request->tipo_de_envio.$request->tamano.$request->aplicar_costo_de_caja.$request->cuenta_con_seguro.$request->tiempo_de_entrega.$request->costo_por_envio;

      $costo = 0;
      if($costo_de_envio->aplic_cos_caj == 'Si') {
        if($costo_de_envio->met_de_entreg == 'Transportes Ferro' AND $costo_de_envio->tip_env == 'Consolidado') {
          switch ($costo_de_envio->tam) {
            case 'Chico':
              $costo = env('COSTO_CHICO_ESP');
              break;
            case 'Mediano':
              $costo = env('COSTO_MEDIANO_ESP');
              break;
            case 'Grande':
              $costo = env('COSTO_GRANDE_ESP');
              break;
          }
        } else {
          switch ($costo_de_envio->tam) {
            case 'Chico':
              $costo = env('COSTO_CHICO');
              break;
            case 'Mediano':
              $costo = env('COSTO_MEDIANO');
              break;
            case 'Grande':
              $costo = env('COSTO_GRANDE');
              break;
          }
        }
      }

      $costo_de_envio->cost_tam_caj       = $costo;
      $costo_de_envio->seg                = $request->cuenta_con_seguro;
      $costo_de_envio->tiemp_ent          = $request->tiempo_de_entrega;
      $costo_de_envio->cost_por_env       = $request->costo_por_envio;
      $costo_de_envio->asignado_env       = Auth::user()->email_registro;
      $costo_de_envio->created_at_env     = Auth::user()->email_registro;
      $costo_de_envio->save();
      
      DB::commit();
      return $costo_de_envio;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function update($request, $id_costo) {
    try { DB::beginTransaction();
      $costo_de_envio                     = $this->costoDeEnvioAsignadoFindOrFailById($this->serviceCrypt->encrypt($id_costo));
      $costo_de_envio->for_loc            = $request->foraneo_o_local;
      $costo_de_envio->met_de_entreg      = $request->metodo_de_entrega;
      $costo_de_envio->met_de_entreg_esp  = $request->metodo_de_entrega_especifico;
      $costo_de_envio->cant               = $request->cantidad;
      $costo_de_envio->trans              = $request->transporte;
      $costo_de_envio->est                = $request->estado;
      $costo_de_envio->tot_unit           = $request->total_o_unitario;
      $costo_de_envio->mun                = $request->municipio;
      $costo_de_envio->tip_env            = $request->tipo_de_envio;
      $costo_de_envio->tam                = $request->tamano;
      $costo_de_envio->aplic_cos_caj      = $request->aplicar_costo_de_caja;

      $costo = 0;
      if($costo_de_envio->aplic_cos_caj == 'Si') {
        if($costo_de_envio->met_de_entreg == 'Transportes Ferro' AND $costo_de_envio->tip_env == 'Consolidado') {
          switch ($costo_de_envio->tam) {
            case 'Chico':
              $costo = env('COSTO_CHICO_ESP');
              break;
            case 'Mediano':
              $costo = env('COSTO_MEDIANO_ESP');
              break;
            case 'Grande':
              $costo = env('COSTO_GRANDE_ESP');
              break;
          }
        } else {
          switch ($costo_de_envio->tam) {
            case 'Chico':
              $costo = env('COSTO_CHICO');
              break;
            case 'Mediano':
              $costo = env('COSTO_MEDIANO');
              break;
            case 'Grande':
              $costo = env('COSTO_GRANDE');
              break;
          }
        }
      }

      $costo_de_envio->cost_tam_caj       = $costo;
      $costo_de_envio->seg                = $request->cuenta_con_seguro;
      $costo_de_envio->tiemp_ent          = $request->tiempo_de_entrega;
      $costo_de_envio->cost_por_env       = $request->costo_por_envio;

      if($costo_de_envio->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Costos de envío', // Módulo
          'costoDeEnvio.show', // Nombre de la ruta
          $this->serviceCrypt->encrypt($id_costo), // Id del registro debe ir encriptado
          $id_costo, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Foráneo o local', 'Método de entrega', 'Método de entrega especifico', 'Cantidad', 'Transporte', 'Estado', 'Total o unitario', 'Municipio', 'Tipo de envío', 'Tamaño', 'Aplicar costos de caja', 'Costo de caja', 'Cuenta con seguro', 'Tiempo de entrega (Dias)', 'Costo por envío'), // Nombre de los inputs del formulario
          $costo_de_envio, // Request
          array('for_loc', 'met_de_entreg', 'met_de_entreg_esp', 'cant', 'trans', 'est', 'tot_unit', 'mun', 'tip_env', 'tam', 'aplic_cos_caj', 'cost_tam_caj', 'seg', 'tiemp_ent', 'cost_por_env') // Nombre de los campos en la BD
        ); 
        $costo_de_envio->updated_at_env  = Auth::user()->email_registro;
      }
      $costo_de_envio->registr            = $request->foraneo_o_local.$request->metodo_de_entrega.$request->metodo_de_entrega_especifico.$request->cantidad.$request->transporte.$request->estado.$request->total_o_unitario.$request->municipio.$request->tipo_de_envio.$request->tamano.$request->aplicar_costo_de_caja.$request->cuenta_con_seguro.$request->tiempo_de_entrega.$request->costo_por_envio;
      $costo_de_envio->save();

      DB::commit();
      return $costo_de_envio;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_costo) {
    try { DB::beginTransaction();
      $costo_de_envio = $this->costoDeEnvioAsignadoFindOrFailById($id_costo);
      $costo_de_envio->delete();
      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Costos de envío', // Nombre del módulo del sistema
        'registro'    => $costo_de_envio->est, // Información a mostrar en la papelera
        'tab'         => 'costos_de_envio', // Nombre de la tabla en la BD
        'id_reg'      => $costo_de_envio->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación           
      ]);

      DB::commit();
      return $costo_de_envio;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function obtener($request) {
    $datos = CostoDeEnvio::metodoDeEntrega($request->metodo_de_entrega)->estado($request->estado)->tipoDeEnvio($request->tipo_de_envio)->tamano($request->tamano)->sinSeleccion($request->metodo_de_entrega, $request->estado, $request->tipo_de_envio, $request->tamano)->orderBy('cost_por_env', 'ASC')->get();
    return $datos;
  }
}