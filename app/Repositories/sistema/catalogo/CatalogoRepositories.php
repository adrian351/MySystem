<?php
namespace App\Repositories\sistema\catalogo;
// Models
use App\Models\Catalogo;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class CatalogoRepositories implements CatalogoInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt               = $serviceCrypt;
    $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
  }
  public function catalogoAsignadoFindOrFailById($id_catalogo) {
    $id_catalogo = $this->serviceCrypt->decrypt($id_catalogo);
    return Catalogo::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->findOrFail($id_catalogo);
  }
  public function getPagination($request) {
    return Catalogo::where('input', '!=', 'Productos (Etiqueta)')->where('input', '!=', 'Productos (Categoría)')->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    DB::transaction(function() use($request) { // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $catalogo = new Catalogo();
      $catalogo->input 			    = $request->input;
      $catalogo->value          = $request->value;
      $catalogo->vista          = $request->value;
      $catalogo->asignado_cat   = Auth::user()->email_registro;
      $catalogo->created_at_cat = Auth::user()->email_registro;
      $catalogo->save();
      return $catalogo;
    });
  }
  public function update($request, $id_catalogo) {
    DB::transaction(function() use($request, $id_catalogo) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $catalogo         = $this->catalogoAsignadoFindOrFailById($id_catalogo);
      $catalogo->input 	= $request->input;
      $catalogo->value  = $request->value;
      $catalogo->vista  = $request->value;
      if($catalogo->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Catalogos', // Módulo
          'sistema.catalogo.show', // Nombre de la ruta
          $id_catalogo, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_catalogo), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Input', 'Value', 'Vista'), // Nombre de los inputs del formulario
          $catalogo, // Request
          array('input', 'value', 'vista') // Nombre de los campos en la BD
        ); 
        $catalogo->updated_at_cat  = Auth::user()->email_registro;
      }
      $catalogo->save();
      return $catalogo;
    });
  }
  public function destroy($id_catalogo) {
    try { DB::beginTransaction();
      $catalogo = $this->catalogoAsignadoFindOrFailById($id_catalogo);
      $catalogo->delete();
      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Catálogos', // Nombre del módulo del sistema
        'registro'    => $catalogo->vista, // Información a mostrar en la papelera
        'tab'         => 'catalogos', // Nombre de la tabla en la BD
        'id_reg'      => $catalogo->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación          
      ]);
      DB::commit();
      return $catalogo;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getAllInputCatalogosPlunk($input) {
    return Catalogo::where('input', $input)->orderBy('vista', 'ASC')->pluck('vista', 'value');
  }
  public function getAllIdCatalogosPlunk($input) {
    return Catalogo::where('input', $input)->orderBy('vista', 'ASC')->pluck('vista', 'id');
  }
}