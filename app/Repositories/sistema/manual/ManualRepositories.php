<?php
namespace App\Repositories\sistema\manual;
// Models
use App\Models\Manual;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use DB;

class ManualRepositories implements ManualInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt               = $serviceCrypt;
    $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
  }
  public function manualFindOrFailById($id_manual) {
    $id_manual = $this->serviceCrypt->decrypt($id_manual);
    return Manual::findOrFail($id_manual);
  }
  public function getPagination($request) {
    return Manual::buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try { DB::beginTransaction();
      $manual = new Manual();
      $manual->usu_cli_ambos  = $request->usuario_que_puede_visualizarlo;
      $manual->valor          = $request->valor;
      $manual->created_at_reg = Auth::user()->email_registro;

      if($request->hasfile('archivo')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('archivo'), // Archivo blob
          'sistema/manuales/'.$manual->valor, // Ruta en la que guardara el archivo
          'manual-'.time().'.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        ); 
        $manual->rut  = $imagen[0]['ruta'];
        $manual->nom  = $imagen[0]['nombre'];
      }

      if($request->hasfile('archivo_editable')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen_edit = ArchivoCargado::dispatch(
          $request->file('archivo_editable'), // Archivo blob
          'sistema/manuales/'.$manual->valor, // Ruta en la que guardara el archivo
          'manual-'.time().'.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        ); 
        $manual->rut_edit  = $imagen_edit[0]['ruta'];
        $manual->nom_edit  = $imagen_edit[0]['nombre'];
      }

      $manual->save();
      $this->eliminarCacheAllManuales();

      DB::commit();
      return $manual;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function update($request, $id_manual) {
    try { DB::beginTransaction();
      $manual                 = $this->manualFindOrFailById($id_manual);
      $manual->usu_cli_ambos  = $request->usuario_que_puede_visualizarlo;
      $manual->valor          = $request->valor;

      if($manual->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Sistema (Manuales)', // Módulo
          'manual.show', // Nombre de la ruta
          $id_manual, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_manual), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Usuario que puede visualizarlo', 'Valor'), // Nombre de los inputs del formulario
          $manual, // Request
          array('usu_cli_ambos', 'valor') // Nombre de los campos en la BD
        ); 
        $manual->updated_at_reg  = Auth::user()->email_registro;
      }

      if($request->hasfile('archivo')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('archivo'), // Archivo blob
          'sistema/manuales/'.$manual->valor, // Ruta en la que guardara el archivo
          'manual-'.time().'.', // Nombre del archivo
          $manual->nom // Ruta y nombre del archivo anterior
        ); 
        $manual->rut  = $imagen[0]['ruta'];
        $manual->nom  = $imagen[0]['nombre'];
      }

      if($request->hasfile('archivo_editable')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen_edit = ArchivoCargado::dispatch(
          $request->file('archivo_editable'), // Archivo blob
          'sistema/manuales/'.$manual->valor, // Ruta en la que guardara el archivo
          'manual-'.time().'.', // Nombre del archivo
          $manual->nom_edit // Ruta y nombre del archivo anterior
        ); 
        $manual->rut_edit  = $imagen_edit[0]['ruta'];
        $manual->nom_edit  = $imagen_edit[0]['nombre'];
      }

      $manual->save();
      $this->eliminarCacheAllManuales();

      DB::commit();
      return $manual;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_manual) {
    try { DB::beginTransaction();
      $manual = $this->manualFindOrFailById($id_manual);
      $manual->delete();
      $this->eliminarCacheAllManuales();

      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Sistema (Manuales)', // Nombre del módulo del sistema
        'registro'    => $manual->valor, // Información a mostrar en la papelera
        'tab'         => 'manuales', // Nombre de la tabla en la BD
        'id_reg'      => $manual->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación          
      ]);

      DB::commit();
      return $manual;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function eliminarCacheAllManuales() {
    Cache::pull('allManuales'); // Elimina la cache con el nombre espesificado
  }
}