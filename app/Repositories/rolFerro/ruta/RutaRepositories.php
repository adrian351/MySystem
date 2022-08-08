<?php
namespace App\Repositories\rolFerro\ruta;
// Models
use App\Models\Ruta;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class RutaRepositories implements RutaInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt               = $serviceCrypt;
    $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
  }
  public function rutaFindOrFailById($id_ruta, $relaciones) {
    $id_ruta = $this->serviceCrypt->decrypt($id_ruta);
    return Ruta::with($relaciones)->findOrFail($id_ruta);
  }
  public function getPagination($request) {
    return Ruta::buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try { DB::beginTransaction();
      $ruta = new Ruta();
      $ruta->nom 			      = $request->nombre_de_la_ruta;
      $ruta->created_at_reg = Auth::user()->email_registro;
      $ruta->save();
      
      $ruta->rut = 'R'.$ruta->id;
      $ruta->save();

      DB::commit();
      return $ruta;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function update($request, $id_ruta) {
    try { DB::beginTransaction();
      $ruta       = $this->rutaFindOrFailById($id_ruta, []);
      $ruta->nom  = $request->nombre_de_la_ruta;
     
      if($ruta->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Rutas (Rol Ferro)', // Módulo
          'rolFerro.ruta.show', // Nombre de la ruta
          $id_ruta, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_ruta), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Nombre de la ruta'), // Nombre de los inputs del formulario
          $ruta, // Request
          array('nom') // Nombre de los campos en la BD
        ); 
        $ruta->updated_at_reg  = Auth::user()->email_registro;
      }
    
      $ruta->save();

      DB::commit();
      return $ruta;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_ruta) {
    try { DB::beginTransaction();
      $ruta = $this->rutaFindOrFailById($id_ruta, []);
      $ruta->forceDelete();

      DB::commit();
      return $ruta;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function allRutasPlunk() {
    return Ruta::orderBy('nom', 'ASC')->pluck('nom', 'rut');
  }
}