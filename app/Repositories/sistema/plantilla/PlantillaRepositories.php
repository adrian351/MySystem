<?php
namespace App\Repositories\sistema\plantilla;
// Models
use App\Models\Plantilla;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
use App\Repositories\servicio\fOpen\ServiceFopen;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class PlantillaRepositories implements PlantillaInterface {
  protected $serviceCrypt;
  protected $serviceFopen;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ServiceFopen $serviceFopen, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt               = $serviceCrypt;
    $this->serviceFopen               = $serviceFopen;
    $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
  }
  public function plantillaAsignadoFindOrFailById($id_plantilla) {
    $id_plantilla = $this->serviceCrypt->decrypt($id_plantilla);
    return Plantilla::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->findOrFail($id_plantilla);
  } 
  public function plantillaFindOrFailById($id_plantilla) {
    return Plantilla::findOrFail($id_plantilla);
  }
  public static function accesoModelPlantillaFindOrFailById($id_plantilla) {
    return Plantilla::findOrFail($id_plantilla);
  } 
  public function getPagination($request) {
    return Plantilla::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try { DB::beginTransaction();
      if(env('APP_ENV') == 'local') {
        $ruta = 'resources\views\correo\\';
      } elseif(env('APP_ENV') == 'production') {
        $ruta= 'resources/views/correo/';
      }
      $plantilla = new Plantilla();
      $plantilla->nom 			      = $request->nombre_de_la_plantilla;
      $plantilla->mod             = $request->modulo;
      $plantilla->asunt           = $request->asunto;
      $plantilla->dis_de_la_plant = $request->diseno_de_la_plantilla;
      $plantilla->asignado_plan   = Auth::user()->email_registro;
      $plantilla->created_at_plan	= Auth::user()->email_registro;
      $plantilla->save();
      $this->serviceFopen->fopen($ruta, $plantilla->id, $plantilla->dis_de_la_plant); // Este en local
      DB::commit();
      return $plantilla;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function update($request, $id_plantilla) {
    try { DB::beginTransaction();
      if(env('APP_ENV') == 'local') {
        $ruta = 'resources\views\correo\\';
      } elseif(env('APP_ENV') == 'production') {
        $ruta= $ruta= 'resources/views/correo/';
      }
      $plantilla = $this->plantillaAsignadoFindOrFailById($id_plantilla);
      $plantilla->nom             = $request->nombre_de_la_plantilla;
      $plantilla->asunt           = $request->asunto;
      $plantilla->dis_de_la_plant = $request->diseno_de_la_plantilla;
      if($plantilla->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Plantillas', // Módulo
          'sistema.plantilla.show', // Nombre de la ruta
          $id_plantilla, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_plantilla), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Nombre de la plantilla', 'Asunto', 'Diseño de la plantilla'), // Nombre de los inputs del formulario
          $plantilla, // Request
          array('nom', 'asunt', 'dis_de_la_plant') // Nombre de los campos en la BD
        ); 
        $plantilla->updated_at_plan  = Auth::user()->email_registro;
      }
      $plantilla->save();
      $this->serviceFopen->fopen($ruta, $plantilla->id, $plantilla->dis_de_la_plant);
      DB::commit();
      return $plantilla;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_plantilla) {
    try { DB::beginTransaction();
      $plantilla = $this->plantillaAsignadoFindOrFailById($id_plantilla);
      $plantilla->delete();
      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Plantillas', // Nombre del módulo del sistema
        'registro'    => $plantilla->nom, // Información a mostrar en la papelera
        'tab'         => 'plantillas', // Nombre de la tabla en la BD
        'id_reg'      => $plantilla->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación          
      ]);
      DB::commit();
      return $plantilla;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getAllPlantillasModuloPluck($modulo) {
    return Plantilla::where('mod', $modulo)->orderBy('nom', 'ASC')->pluck('nom', 'id');
  }
}