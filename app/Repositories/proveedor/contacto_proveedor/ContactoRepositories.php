<?php
namespace App\Repositories\proveedor\contacto_proveedor;
// Models
use App\Models\ContactoProveedor;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Events
use App\Events\layouts\ActividadRegistrada;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ContactoRepositories implements ContactoInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->papeleraDeReciclajeRepo  = $papeleraDeReciclajeRepositories;
  } 
  public function contactoFindOrFailById($id_contacto) {
    $id_contacto = $this->serviceCrypt->decrypt($id_contacto);
    return ContactoProveedor::with('proveedor')->findOrFail($id_contacto);
  }
  public function store($request, $id_proveedor) {
    DB::transaction(function() use($request, $id_proveedor) { // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $contacto                   = new ContactoProveedor();
      $contacto->nom              = $request->nombre;
      $contacto->carg             = $request->cargo;
      $contacto->corr             = $request->correo;
      $contacto->lad_fij          = $request->lada_telefono_fijo;
      $contacto->tel_fij          = $request->telefono_fijo;
      $contacto->ext              = $request->extension;
      $contacto->lad_mov          = $request->lada_telefono_movil;
      $contacto->tel_mov          = $request->telefono_movil;
      $contacto->obs              = $request->observaciones;
      $contacto->proveedor_id     = $this->serviceCrypt->decrypt($id_proveedor);
      $contacto->created_at_prov_cont = Auth::user()->email_registro;
      $contacto->save();
      return $contacto;
    });
  }
  public function update($request, $id_contacto) {
    DB::transaction(function() use($request, $id_contacto) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $contacto = $this->contactoFindOrFailById($id_contacto);
      $contacto->nom      = $request->nombre;
      $contacto->carg     = $request->cargo;
      $contacto->corr     = $request->correo;
      $contacto->lad_fij  = $request->lada_telefono_fijo;
      $contacto->tel_fij  = $request->telefono_fijo;
      $contacto->ext      = $request->extension;
      $contacto->lad_mov  = $request->lada_telefono_movil;
      $contacto->tel_mov  = $request->telefono_movil;
      $contacto->obs      = $request->observaciones;
      if($contacto->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Contacto proveedor', // Módulo
          'proveedor.contacto.show', // Nombre de la ruta
          $id_contacto, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_contacto), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Nombre', 'Cargo', 'Correo', 'Lada teléfono fijo', 'Teléfono fijo', 'Extensión', 'Lada teléfono móvil', 'Teléfono móvil', 'Observaciones'), // Nombre de los inputs del formulario
          $contacto, // Request
          array('nom', 'carg', 'corr', 'lad_fij', 'tel_fij', 'ext', 'lad_mov', 'tel_mov', 'obs') // Nombre de los campos en la BD
        ); 
        $contacto->updated_at_prov_cont = Auth::user()->email_registro;
      }
      $contacto->save();
      return $contacto;
    });
  }
  public function destroy($id_contacto) {
    try { DB::beginTransaction();
      $contacto = $this->contactoFindOrFailById($id_contacto);
      $contacto->delete();
      // Manda el registro a la papelera de reciclaje
      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Contacto proveedor', // Nombre del módulo del sistema
        'registro'    => $contacto->nom, // Información a mostrar en la papelera
        'tab'         => 'contactos_proveedores', // Nombre de la tabla en la BD
        'id_reg'      => $contacto->id, // ID de registro eliminado 
        'id_fk'       => $contacto->proveedor->id // ID de la llave foranea con la que tiene relación             
      ]);
      DB::commit();
      return $contacto;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}