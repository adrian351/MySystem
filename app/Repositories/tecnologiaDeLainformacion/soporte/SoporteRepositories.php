<?php
namespace App\Repositories\tecnologiaDeLainformacion\soporte;
//Models
use App\Models\Soporte;
use App\Models\SoporteArchivo;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
use App\Repositories\tecnologiaDeLainformacion\inventarioEquipo\historial_inventario\HistorialInvRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
//Otros
use Illuminate\Support\Facades\Auth;
use DB;

class SoporteRepositories implements  SoporteInterface {  
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  protected $historialInvRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories,HistorialInvRepositories $historialInvRepositories){
    $this->serviceCrypt             = $serviceCrypt;
    $this->papeleraDeReciclajeRepo  = $papeleraDeReciclajeRepositories;
    $this->historialInvRepo         = $historialInvRepositories;
  }
  public function soporteFindOrFailById($id_soporte, $relaciones){
    $id_soporte = $this->serviceCrypt->decrypt($id_soporte);
    $soporte = Soporte::with($relaciones)->findOrFail($id_soporte);
    return $soporte;
  }
  public function getPagination($request){
    return Soporte::buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try{ DB::beginTransaction();
      $soporte                       = new Soporte();
      $soporte->sol                  = $request->nombre_del_solicitante;
      $soporte->emp                  = $request->empresa;
      $soporte->area_dep             = $request->area_departamento;
      $soporte->tel_fij              = $request->telefono_fijo;
      $soporte->ext                  = $request->extension;
      $soporte->des_de_la_falla      = $request->descripcion_de_la_falla;
      $soporte->save();
      
      if($request->archivos > 0 ) {
        $camposBD   = array('arc_rut', 'arc_nom', 'soporte_id', 'created_at');
        $hastaC     = count($request->archivos) - 1;
        $datos      = null;
        $contador3  = 0;

        for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
          // Dispara el evento registrado en App\Providers\EventServiceProvider.php
          $archivos = ArchivoCargado::dispatch(
            $request->archivos[$contador2], // Archivos blob
            'tecnologiasDeLaInformacion/soporte/' . date("Y"), // Ruta en la que guardara el archivo
            'soporte-' . $contador2 . time() . '.', // Nombre del archivo
            null // Ruta y nombre del archivo anterior
          ); 
          $datos[$contador2][$camposBD[$contador3]] = $archivos[0]['ruta'];
          $contador3 += 1;
          $datos[$contador2][$camposBD[$contador3]] = $archivos[0]['nombre'];
          $contador3 += 1;
          $datos[$contador2][$camposBD[$contador3]] = $soporte->id;
          $contador3 += 1;
          $datos[$contador2][$camposBD[$contador3]] = date('Y-m-d h:i:s');
          $contador3 = 0;
        }
        SoporteArchivo::insert($datos);
      }
      DB::commit();
      return $soporte;            
    } catch (\Exception $e) { DB::rollback(); throw $e; }
  }
  public function update($request, $id_soporte){
    try{ DB::beginTransaction();
      $soporte = $this->soporteFindOrFailById($id_soporte, ['archivos']);
      if($request->estatus_del_soporte  == 'En espera de compra'){
        $respuesta = $this->actualizarSoporte($request, $soporte);
      }
      elseif($request->estatus_del_soporte  == 'Terminado'){
        $respuesta = $this->agregarSoporteaHistorial($request, $soporte);
      }
      DB::commit();
      return $respuesta;            
    } catch (\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_soporte){
    try{ DB::beginTransaction();
      $soporte = $this->soporteFindOrFailById($id_soporte, []);
      $soporte->delete();
      $this->papeleraDeReciclajeRepo->store([
        'modulo'      =>    'Soportes', // Nombre del módulo del sistema
        'registro'    =>    $soporte->sol,  // Información a mostrar en la papelera
        'tab'         =>    'soportes', // Nombre de la tabla en la BD
        'id_reg'      =>    $soporte->id,  // ID de registro eliminado
        'id_fk'       =>    null // ID de la llave foranea con la que tiene relación
      ]);
      DB::commit();
      return $soporte;            
    } catch (\Exception $e) { DB::rollback(); throw $e; }
  }
  public function actualizarSoporte($request, $soporte){
    $soporte->est                       = $request->estatus_del_soporte;   
    $soporte->tec                       = $request->nombre_del_tecnico;
    $soporte->id_equipo                 = $request->id_inventario;
    $soporte->grup_de_falla             = $request->agrupacion_de_fallas;  
    $soporte->solu                      = $request->solucion;
    $soporte->obs_del_equipo            = $request->observaciones_del_equipo;
    if($soporte->isDirty()) {
      // Dispara el evento registrado en App\Providers\EventServiceProvider.php  
      ActividadRegistrada::dispatch(
        'Soportes', //Modulo
        'soporte.show', //Nombre de la ruta
        $this->serviceCrypt->encrypt( $soporte->id), //id del registro encriptado
        $soporte->id, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
        array('Estatus del reporte', 'Nombre del técnico', 'ID inventario', 'Agrupación de fallas', 'Solución', 'Observaciones del equipo'), // Nombre de los inputs del formulario
        $soporte, //Request
        array('est', 'tec', 'id_equipo', 'grup_de_falla', 'solu', 'obs_del_equipo') // Nombre de los campos en la BD                    
      );
      $soporte->update_at_sop = Auth::user()->email_registro;
    }
    $soporte->save();
    return 'Actualizado';
  }
  public function agregarSoporteaHistorial($request, $soporte) {
    $request->fecha_en_la_que_se_solicito_el_soporte = \Carbon\Carbon::parse($soporte->created_at)->format('Y-m-d h:i:s');
    $this->historialInvRepo->store($request, $soporte->archivos);
    $soporte->forceDelete();
    return 'Eliminado';
  }
}