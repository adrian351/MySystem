<?php
namespace App\Repositories\rolCliente\direccion;
// Models
use App\Models\Direccion;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Events
use App\Events\layouts\ActividadRegistrada;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class DireccionRepositories implements DireccionInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function getDireccionFindOrFail($id_direccion, $relaciones) {
    $id_direccion = $this->serviceCrypt->decrypt($id_direccion);
    return Direccion::with($relaciones)->where('user_id', Auth::user()->id)->findOrFail($id_direccion);
  }
  public function getPagination($request) {
    return Direccion::where('user_id', Auth::user()->id)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try { DB::beginTransaction();
      $direccion = new Direccion();
      $direccion = $this->storeFields($direccion, $request);
      $direccion->user_id             = Auth::user()->id;
      $direccion->created_at_direc    = Auth::user()->email_registro; 
      $direccion->save();
      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function storeFields($direccion, $request) {
    $direccion->nom_ref_uno         = $request->nombre_de_la_persona_que_recibe_uno;
    $direccion->nom_ref_dos         = $request->nombre_de_la_persona_que_recibe_dos;
    $direccion->lad_fij             = $request->lada_telefono_fijo;
    $direccion->tel_fij             = $request->telefono_fijo;
    $direccion->ext                 = $request->extension;
    $direccion->lad_mov             = $request->lada_telefono_movil;
    $direccion->tel_mov             = $request->telefono_movil;
    $direccion->calle               = $request->calle;
    $direccion->no_ext              = $request->no_exterior;
    $direccion->no_int              = $request->no_interior;
    $direccion->pais                = 'México';
    $direccion->ciudad              = $request->ciudad;
    $direccion->col                 = $request->colonia;
    $direccion->del_o_munic         = $request->delegacion_o_municipio;
    $direccion->cod_post            = $request->codigo_postal;
    $direccion->ref_zon_de_entreg   = $request->referencias_zona_de_entrega;
    return $direccion;
  }
  public function update($request, $id_direccion) {
    try { DB::beginTransaction();
      $direccion = $this->getDireccionFindOrFail($id_direccion, []);
      $direccion = $this->storeFields($direccion, $request);
       
      if($direccion->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Direcciones (Cliente)', // Módulo
          'rolCliente.direccion.show', // Nombre de la ruta
          $id_direccion, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_direccion), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Nombre de la persona que recibe uno', 'Nombre de la persona que recibe dos', 'Lada teléfono fijo', 'Teléfono fijo', 'Extensión', 'Lada teléfono móvil', 'Teléfono móvil', 'Calle' ,'No. Exterior' ,'No. Interior' ,'País' ,'Ciudad' ,'Colonia' ,'Delegación o municipio' ,'Código postal' ,'Referencias zona de entrega'), // Nombre de los inputs del formulario
          $direccion, // Request
          array('nom_ref_uno', 'nom_ref_dos', 'lad_fij', 'tel_fij', 'ext', 'lad_mov', 'tel_mov', 'calle', 'no_ext', 'no_int', 'pais', 'ciudad', 'col', 'del_o_munic', 'cod_post', 'ref_zon_de_entreg') // Nombre de los campos en la BD
        ); 
        $direccion->updated_at_direc  = Auth::user()->email_registro;
      }
      
      $direccion->save();
      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_direccion) {
    try { DB::beginTransaction();
      $direccion = $this->getDireccionFindOrFail($id_direccion, []);
      $direccion->forceDelete();

      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getDireccionesClientePluck() {
    return Direccion::where('user_id', Auth::user()->id)->orderBy('del_o_munic', 'ASC')->pluck('del_o_munic', 'id');
  }
  public function getDireccionFind($id_direccion) {
    return Direccion::where('user_id', Auth::user()->id)->where('id', $id_direccion)->findOrFail($id_direccion);
  }
  public function getDireccion($id_direccion) {
    return Direccion::findOrFail($id_direccion);
  }
}