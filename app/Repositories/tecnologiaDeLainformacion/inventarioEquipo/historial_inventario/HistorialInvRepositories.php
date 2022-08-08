<?php 
namespace App\Repositories\tecnologiaDeLainformacion\inventarioEquipo\historial_inventario;
//Models
use App\Models\Historial;
use App\Models\HistorialArchivo;
//Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
//Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class HistorialInvRepositories implements HistorialInvInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->papeleraDeReciclajeRepo  = $papeleraDeReciclajeRepositories;
  }
  public function historialFindOrFailById($id_historial) {
    $id_historial = $this->serviceCrypt->decrypt($id_historial);
    return Historial::with('equipo')->findOrFail($id_historial);
  }
  public function store($request, $archivos) {
    try{ DB::beginTransaction();
      $historial                          = new Historial();
      $historial->fec_sol_sop             = $request->fecha_en_la_que_se_solicito_el_soporte;
      $historial->sol                     = $request->nombre_del_solicitante;
      $historial->area_dep                = $request->area_departamento;
      $historial->tec                     = $request->nombre_del_tecnico;
      $historial->inventario_equipo_id    = $request->id_inventario;
      $historial->grup_de_falla           = $request->agrupacion_de_fallas;
      $historial->solu                    = $request->solucion;
      $historial->obs_del_equipo          = $request->observaciones_del_equipo;
      $historial->des_de_la_falla         = $request->descripcion_de_la_falla;
      $historial->created_at_his          = Auth::user()->email_registro;
      $historial->save();

      /**
       * Guarda los archivos relacionados al historial
      */
      $imagenes = [];
      $contador = 0;
      foreach($archivos as $archivo) {
          $imagenes[$contador]['his_arch_rut'] = $archivo->arc_rut;
          $imagenes[$contador]['his_arch'] = $archivo->arc_nom;
          $imagenes[$contador]['historial_id'] = $historial->id;
          $contador ++;
      }
      HistorialArchivo::insert($imagenes);
      DB::commit();
      return $historial;            
    } catch (\Exception $e) { DB::rollback(); throw $e; }
  }
}