<?php
namespace App\Repositories\sistema\serie;
// Models
use App\Models\Serie;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class SerieRepositories implements SerieInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt               = $serviceCrypt;
    $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
  }
  public function serieAsignadoFindOrFailById($id_serie) {
      $id_serie = $this->serviceCrypt->decrypt($id_serie);
      return Serie::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->findOrFail($id_serie);
    }
  public function getPagination($request) {
    return Serie::buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    DB::transaction(function() use($request) { // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $serie = new Serie();
      $serie->input 			   = $request->input;
      $serie->value          = $request->value;
      $serie->vista          = $request->value;
      $serie->asignado_ser   = Auth::user()->email_registro;
      $serie->created_at_ser = Auth::user()->email_registro;
      $serie->save();
      return $serie;
    });
  }
  public function update($request, $id_serie) {
    DB::transaction(function() use($request, $id_serie) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $serie         = $this->serieAsignadoFindOrFailById($id_serie);
      $serie->input  = $request->input;
      $serie->value  = $request->value;
      if($serie->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Series', // Módulo
          'sistema.serie.show', // Nombre de la ruta
          $id_serie, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_serie), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Input', 'Value', 'Vista'), // Nombre de los inputs del formulario
          $serie, // Request
          array('input', 'value', 'vista') // Nombre de los campos en la BD
        ); 
        $serie->updated_at_ser  = Auth::user()->email_registro;
      }
      $serie->vista  = $request->value;
      $serie->save();
      return $serie;
    });
  }
  public function destroy($id_serie) {
    try { DB::beginTransaction();
      $serie = $this->serieAsignadoFindOrFailById($id_serie);
      $serie->delete();
      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Series', // Nombre del módulo del sistema
        'registro'    => $serie->vista, // Información a mostrar en la papelera
        'tab'         => 'series', // Nombre de la tabla en la BD
        'id_reg'      => $serie->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación          
      ]);
      DB::commit();
      return $serie;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getAllInputSeriesPlunk($input) {
    return Serie::where('input', $input)->orderBy('vista', 'ASC')->pluck('vista', 'value');
  }
  public function sumaUnoALaUltimaSerie($input, $vista) {
    $serie = Serie::where('input', $input)->where('vista', $vista)->first();
    if($serie == null) {
      return abort(403, 'No sé a definido una serie por default');
    }
    $serie->ult_ser += 1;
    $serie->save();
    return $vista.$serie->ult_ser;
  }
}