<?php
namespace App\Repositories\tecnologiaDeLainformacion\inventarioEquipo\archivoInventario;
//Models
use App\Models\InventarioEquipoArchivo;
//Events
use App\Events\layouts\ArchivoCargado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
//Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use DB;

class ArchivoInventarioRepositories implements ArchivoInventarioInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt     = $serviceCrypt;
    $this->papeleraDeReciclajeRepo = $papeleraDeReciclajeRepositories;
    }
  public function archivoInventarioFindOrFailById($id_archivo) {
    $id_archivo = $this->serviceCrypt->decrypt($id_archivo);
    $archivo = InventarioEquipoArchivo::findOrFail($id_archivo);
    return $archivo;
  }
  public function store($request, $id_inventario) {
    DB::transaction(function() use($request, $id_inventario){ // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $camposBD   = array('arc_rut', 'arc_nom', 'inventario_equipo_id', 'created_at');
      $hastaC     = count($request->imagenes) - 1;
      $datos      = null;
      $contador3  = 0;
      $id_inventario  = $this->serviceCrypt->decrypt($id_inventario);
      
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
        $datos[$contador2][$camposBD[$contador3]] = $id_inventario;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = date('Y-m-d h:i:s');
        $contador3 = 0;
      }
      InventarioEquipoArchivo::insert($datos);
      return true;
    });
  }
  public function destroy($id_archivo){
    try{ DB::beginTransaction();
      $archivo = $this->archivoInventarioFindOrFailById($id_archivo);
      $archivo->delete();
      $this->papeleraDeReciclajeRepo->store([
        'modulo'      =>    'Inventario', // Nombre del módulo del sistema
        'registro'    =>    $archivo->arc_nom,  // Información a mostrar en la papelera
        'tab'         =>    'inventario_equipos_archivos', // Nombre de la tabla en la BD
        'id_reg'      =>    $archivo->id,  // ID de registro eliminado
        'id_fk'       =>    $archivo->inventario->id, // ID de la llave foranea con la que tiene relación
      ]);
      DB::commit();
      return $archivo;
    } catch (\Exception $e) { DB::rollback(); throw $e; }
  }
}