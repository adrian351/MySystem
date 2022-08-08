<?php
namespace App\Repositories\rol\permiso;
// Models
use Spatie\Permission\Models\Permission;
// use Spatie\Permission\PermissionBuscar;

// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class PermisoRepositories implements PermisoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt   = $serviceCrypt;
  } 
  public function rolFindOrFailById($id_permiso) {
    $id_permiso = $this->serviceCrypt->decrypt($id_permiso);
    return Permission::findOrFail($id_permiso);
  }
  public function getPagination($request) {
    // linea modificada: Permisiion::buscar
    return Permission::where($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function getAllPermissionsPluck() {
    return Permission::orderBy('nom', 'ASC')->pluck('nom', 'id');
  }
}