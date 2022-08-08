<?php
namespace App\Repositories\rol\rol;
// Models
use Spatie\Permission\Models\Role;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class RolRepositories implements RolInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->papeleraDeReciclajeRepo  = $papeleraDeReciclajeRepositories;
  } 
  public function rolAsignadoFindOrFailById($id_rol) {
    $id_rol = $this->serviceCrypt->decrypt($id_rol);
    $rol = Role::where('name', '!=', config('app.rol_desarrollador'))->where('name', '!=', config('app.rol_ferro'))->where('name', '!=', config('app.
    rol_sin_acceso_al_sistema'))->where('name', '!=', config('app.rol_cliente'))->asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->with(['permissions'=> function ($query) {                                     //linea modificada : asignado
        $query->orderBy('nom', 'ASC');
      }])->findOrFail($id_rol);
    return $rol;
  }
  public function getPagination($request) {
    return Role::where('name', '!=', config('app.rol_desarrollador'))->where('name', '!=', config('app.rol_ferro'))->where('name', '!=', config('app.rol_sin_acceso_al_sistema'))->where('name', '!=', config('app.rol_cliente'))->asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->where($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    DB::transaction(function() use($request) { // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $rol                  = new Role();
      $rol->nom             = $request->nombre_del_rol;
      $rol->name            = $request->slug;
      $rol->desc            = $request->descripcion;
      $rol->asignado_rol    = Auth::user()->email_registro;
      $rol->created_at_rol  = Auth::user()->email_registro;
      $rol->save();
      $rol->givePermissionTo($request->permisos);
      return $rol;
    });
  }
  public function update($request, $id_rol) {
    DB::transaction(function() use($request, $id_rol) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $rol        = $this->rolAsignadoFindOrFailById($id_rol);
      $rol->nom   = $request->nombre_del_rol;
      $rol->desc  = $request->descripcion;
      if($rol->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Roles', // Módulo 
          'rol.show', // Nombre de la ruta
          $id_rol, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_rol), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Nombre del rol', 'Descripción'),  // Nombre de los inputs del formulario
          $rol, // Request
          array('nom', 'desc') // Nombre de los campos en la BD
        ); 
        $rol->updated_at_rol  = Auth::user()->email_registro;
      }
      $rol->save();
      $rol->permissions()->sync($request->permisos);
      return $rol;
    });
  }
  public function destroy($id_rol) {
    try { DB::beginTransaction();
      $rol = $this->rolAsignadoFindOrFailById($id_rol);
      $rol_usuario = $rol->users()->get();
      if(count($rol_usuario)) { abort(403, '¡Este rol esta vinculado a uno o varios usuarios por lo cual no se puede eliminar!'); } // Verifica si el rol tiene vinculados uno o más usuarios
      $rol->delete();
      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Roles', // Nombre del módulo del sistema
        'registro'    => $rol->nom, // Información a mostrar en la papelera
        'tab'         => 'roles', // Nombre de la tabla en la BD
        'id_reg'      => $rol->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación           
      ]);
      DB::commit();
      return $rol;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getAllRolesPluckMenos($name) {
    // Traer todos los roles menos el que se indique
    $roles = Role::where('name', '!=', $name)->orderBy('nom', 'ASC')->pluck('nom', 'id');
    return $roles;
  }
  public function getSoloDosRolesPluck($name_rol1, $name_rol2) {
    $roles = Role::where('name', $name_rol1)->orWhere('name', $name_rol2)->orderBy('nom', 'ASC')->pluck('nom', 'id');
    return $roles;
  }
}