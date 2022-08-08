<?php
namespace App\Repositories\rolCliente\datoFiscal;
// Models
use App\Models\DatoFiscal;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Events
use App\Events\layouts\ActividadRegistrada;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class DatoFiscalRepositories implements DatoFiscalInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  }
  public function getDatoFiscalFindOrFail($id_dato_fiscal, $relaciones) {
    $id_dato_fiscal = $this->serviceCrypt->decrypt($id_dato_fiscal);
    return DatoFiscal::where('user_id', Auth::user()->id)->with($relaciones)->findOrFail($id_dato_fiscal);
  }
  public function getPagination($request) {
    return DatoFiscal::where('user_id', Auth::user()->id)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try { DB::beginTransaction();
      $dato_fiscal                      = new DatoFiscal();
      $dato_fiscal                      = $this->storeFields($dato_fiscal, $request);
      $dato_fiscal->user_id             = Auth::user()->id;
      $dato_fiscal->created_at_dat_fisc = Auth::user()->email_registro;
      $dato_fiscal->save();
      DB::commit();
      return $dato_fiscal;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function storeFields($dato_fiscal, $request) {
    $dato_fiscal->nom_o_raz_soc       = $request->nombre_o_razon_social;
    $dato_fiscal->rfc                 = $request->rfc;
    $dato_fiscal->lad_fij             = $request->lada_telefono_fijo;
    $dato_fiscal->tel_fij             = $request->telefono_fijo;
    $dato_fiscal->ext                 = $request->extension;
    $dato_fiscal->lad_mov             = $request->lada_telefono_movil;
    $dato_fiscal->tel_mov             = $request->telefono_movil;
    $dato_fiscal->calle               = $request->calle;
    $dato_fiscal->no_ext              = $request->no_exterior;
    $dato_fiscal->no_int              = $request->no_interior;
    $dato_fiscal->pais                = $request->pais;
    $dato_fiscal->ciudad              = $request->ciudad;
    $dato_fiscal->col                 = $request->colonia;
    $dato_fiscal->del_o_munic         = $request->delegacion_o_municipio;
    $dato_fiscal->cod_post            = $request->codigo_postal;
    $dato_fiscal->corr                = $request->correo;
    return $dato_fiscal;
  }
  public function update($request, $id_dato_fiscal) {
    try { DB::beginTransaction();
      $dato_fiscal = $this->getDatoFiscalFindOrFail($id_dato_fiscal, []);
      $dato_fiscal = $this->storeFields($dato_fiscal, $request);
       
      if($dato_fiscal->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Datos fiscales (Cliente)', // Módulo
          'rolCliente.datoFiscal.show', // Nombre de la ruta
          $id_dato_fiscal, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_dato_fiscal), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Nombre o razón social', 'RFC', 'Lada teléfono fijo', 'Teléfono fijo', 'Extensión', 'Lada teléfono móvil', 'Teléfono móvil', 'Calle' ,'No. Exterior' ,'No. Interior', 'País' ,'Ciudad' ,'Colonia' ,'Delegación o municipio', 'Código postal', 'Correo'), // Nombre de los inputs del formulario
          $dato_fiscal, // Request
          array('nom_o_raz_soc', 'rfc', 'lad_fij', 'tel_fij', 'ext', 'lad_mov', 'tel_mov', 'calle', 'no_ext', 'no_int', 'pais', 'ciudad', 'col', 'del_o_munic', 'cod_post', 'corr') // Nombre de los campos en la BD
        ); 
        $dato_fiscal->updated_at_dat_fisc  = Auth::user()->email_registro;
      }
      
      $dato_fiscal->save();
      DB::commit();
      return $dato_fiscal;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_dato_fiscal) {
    try { DB::beginTransaction();
      $dato_fiscal = $this->getDatoFiscalFindOrFail($id_dato_fiscal, []);
      $dato_fiscal->forceDelete();

      DB::commit();
      return $dato_fiscal;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getAllDatosFiscalesClientePluck() {
    return DatoFiscal::where('user_id', Auth::user()->id)->orderBy('rfc', 'ASC')->pluck('rfc', 'id');
  }
  public function getDatoFiscal($id_dato_fiscal) {
    $id_dato_fiscal = $this->serviceCrypt->decrypt($id_dato_fiscal);
    return DatoFiscal::findOrFail($id_dato_fiscal);
  }
}