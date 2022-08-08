<?php
namespace App\Repositories\tecnologiaDeLainformacion\inventarioEquipo;
//Models
use App\Models\InventarioEquipo;
use App\Models\InventarioEquipoArchivo;
//Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
//Otros 
use Illuminate\Support\Facades\Auth;
use DB;
  
class InventarioEquipoRepositories implements InventarioEquipoInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt = $serviceCrypt;
    $this->papeleraDeReciclajeRepo = $papeleraDeReciclajeRepositories;
  }
  public function inventarioFindOrFailById($id_inventario) {
    $id_inventario = $this->serviceCrypt->decrypt($id_inventario);
    $inventario = InventarioEquipo::findOrFail($id_inventario);
    return $inventario;
  }
  public function getPagination($request) {
    return InventarioEquipo::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function getAllInventarioEquiposPlunk() {
    return InventarioEquipo::orderBy('id_equipo', 'ASC')->pluck('id_equipo', 'id');
  }
  public function update($request, $id_inventario) {
    DB::transaction(function()use($request, $id_inventario) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $inventario = $this->inventarioFindOrFailById($id_inventario);
      $inventario->emp                    = $request->empresa;
      $inventario->resp                   = $request->responsable;
      $inventario->num_ser                = $request->numero_serie;
      $inventario->mar                    = $request->marca;
      $inventario->mod                    = $request->modelo;
      $inventario->ult_fec_de_man         = $request->ultimo_mantenimiento;
      $inventario->des_del_equ            = $request->descripciom_equipo;
      $inventario->obs                    = $request->observaciones;  
      if($inventario->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php  
        ActividadRegistrada::dispatch(
          'Inventario', //Modulo
          'inventario.show', //Nombre de la ruta 
          $id_inventario, //Id del registro a mostrar, este valor no debe de sobrepasar los 100 caracteres 
          $inventario->id_equipo, //id del registro encriptado
          array('Empresa', 'Responsable', 'Número de Serie', 'Último mantenimiento', 'Marca', 'Modelo', 'Creación Inventario Equipo', 'Actualización Inventario Equipo', 'Descripción del Equipo', 'Observaciones'), //Nombre de lsos Inputs del formulario 
          $inventario, //Request
          array('emp', 'resp', 'num_ser', 'ult_fec_de_man','mar', 'mod', 'created_at_inv_equ', 'updated_at_inv_equ', 'des_del_equ', 'obs')
        );
        $inventario->updated_at_inv_equ = Auth::user()->email_registro;
      }
      $inventario->save();
      return 'Actualizado';
    });
  }
  public function destroy($id_inventario) {
    try{ DB::beginTransaction();
      $inventario = $this->inventarioFindOrFailById($id_inventario);
      $inventario->delete();
      $this->papeleraDeReciclajeRepo->store([
        'modulo'        =>    'Inventario',  // Nombre del módulo del sistema
        'registro'      =>     $inventario->id_equipo,  // Información a mostrar en la papelera
        'tab'           =>     'inventario_equipos',  // Nombre de la tabla en la BD
        'id_reg'        =>     $inventario->id,  // ID de registro eliminado
        'id_fk'         =>     null  // ID de la llave foranea con la que tiene relación
      ]);
      DB::commit();
      return $inventario;
    } catch (\Exception $e) { DB::rollback(); throw $e; }
  }
  public function store($request) {
    DB::transaction(function() use($request){ //Ejecuta la transacción para encapsular todas las consultas y se ejecutan solo si no surgió un error 
      $inventario                        = new InventarioEquipo();
      $inventario->id_equipo             = $request->id_del_equipo;
      $inventario->resp                  = $request->responsable;
      $inventario->emp                   = $request->empresa;
      $inventario->mar                   = $request->marca;
      $inventario->mod                   = $request->modelo;
      $inventario->num_ser               = $request->numero_serie;
      $inventario->ult_fec_de_man        = $request->ultimo_mantenimiento;
      $inventario->prox_fec_de_man       = date("Y-m-d h:i:s", strtotime($inventario->ult_fec_de_man.'+6 months', strtotime(date("Y-m-d"))));
      $inventario->des_del_equ           = $request->descripciom_equipo;
      $inventario->obs                   = $request->observaciones; 
      $inventario->asignado_inv_equ      = Auth::user()->email_registro;
      $inventario->created_at_inv_equ    = Auth::user()->email_registro;
      $inventario->save();

      if($request->imagenes > 0 ) { 
        $camposBD   = array('arc_rut', 'arc_nom', 'inventario_equipo_id', 'created_at');
        $hastaC     = count($request->imagenes) - 1;
        $datos      = null;
        $contador3  = 0;

        for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
          // Dispara el evento registrado en App\Providers\EventServiceProvider.php
            $imagenes = ArchivoCargado::dispatch(
            $request->imagenes[$contador2], // Archivos blob
            'tecnologiasDeLaInformacion/inventario/' . date("Y"), // Ruta en la que guardara el archivo
            'inventario-' . $contador2 . time() . '.', // Nombre del archivo
            null // Ruta y nombre del archivo anterior
          );
          $datos[$contador2][$camposBD[$contador3]] = $imagenes[0]['ruta'];
          $contador3 += 1;
          $datos[$contador2][$camposBD[$contador3]] = $imagenes[0]['nombre'];
          $contador3 += 1;
          $datos[$contador2][$camposBD[$contador3]] = $inventario->id;
          $contador3 += 1;
          $datos[$contador2][$camposBD[$contador3]] = date('Y-m-d h:i:s');
          $contador3 = 0;
        }
        InventarioEquipoArchivo::insert($datos);
      }

      return $inventario;
    });
  }
  public function getArchivosInventario($inventario) { 
    return $inventario->archivos()->paginate(99999999);
  }
  public function getHistorialesInventario($inventario, $request) {
    if($request->opcion_buscador != null) {
      return $inventario->historiales()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $inventario->historiales()->paginate($request->paginador);
  }
}