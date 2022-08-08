<?php
namespace App\Repositories\rolCliente\factura;
// Models
use App\Models\Factura;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\factura\FacturaRepositories;
use App\Repositories\pago\PagoRepositories;
use App\Repositories\rolCliente\datoFiscal\DatoFiscalRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class FacturaClienteRepositories implements FacturaInterface {
  protected $serviceCrypt;
  protected $facturaRepo;
  protected $pagoRepo;
  protected $datoFiscalRepo;
  public function __construct(ServiceCrypt $serviceCrypt, FacturaRepositories $facturaRepositories, PagoRepositories $pagoRepositories, DatoFiscalRepositories $datoFiscalRepositories) {
    $this->serviceCrypt   = $serviceCrypt;
    $this->facturaRepo    = $facturaRepositories;
    $this->pagoRepo       = $pagoRepositories;
    $this->datoFiscalRepo = $datoFiscalRepositories;
  }
  public function getFacturaFindOrFail($id_factura, $relaciones, $opcion) {
    $id_factura = $this->serviceCrypt->decrypt($id_factura);
    $consulta =  Factura::where('user_id', Auth::user()->id)->with($relaciones);
    if($opcion == 'edit') {
      $consulta->where('est_fact', config('app.error_del_cliente'));
    }
    return $consulta->findOrFail($id_factura);
  }
  public function getPagination($request) {
    return Factura::where('user_id', Auth::user()->id)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try { DB::beginTransaction();
      $pago = $this->pagoRepo->getPagoForCodigoFacturacionFindOrFail($request->codigo_de_facturacion, []);

      $factura = new Factura();
      $factura = $this->facturaRepo->storeFields($factura, $request);
      $factura->pago_id         = $pago->id;
      $factura->user_id         = Auth::user()->id;
      $factura->created_at_fact = Auth::user()->email_registro;
      $factura->save();

      /*
      * Cambia el estatus de la factura del pago a Pendiente
      */
      $this->pagoRepo->cambiarEstatusFacturaDelPago($pago, config('app.pendiente'));

      // GUARDA LOS DATOS FISCALES AL PERFIN EL USUARIO SI SE MARCA EL CHECKBOX 
      if($request->checkbox_datos_fiscales == 'on') {
        $dato_fiscal                      = new \App\Models\DatoFiscal();
        $dato_fiscal                      = $this->datoFiscalRepo->storeFields($dato_fiscal, $request);
        $dato_fiscal->user_id             = Auth::user()->id;
        $dato_fiscal->created_at_dat_fisc = Auth::user()->email_registro;
        $dato_fiscal->save();
      }
        
      DB::commit();
      return $factura;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function update($request, $id_factura) {
    try { DB::beginTransaction();
      $factura = $this->getFacturaFindOrFail($id_factura, [], 'edit');
      $factura =$this->datoFiscalRepo->storeFields($factura, $request);

      if($factura->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Facturas (Cliente)', // Módulo
          'rolCliente.factura.show', // Nombre de la ruta
          $id_factura, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_factura), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Nombre o razón social', 'RFC', 'Lada teléfono fijo', 'Teléfono fijo', 'Extensión', 'Lada teléfono móvil', 'Teléfono móvil', 'Calle' ,'No. Exterior' ,'No. Interior', 'País' ,'Ciudad' ,'Colonia' ,'Delegación o municipio', 'Código postal', 'Correo'), // Nombre de los inputs del formulario
          $factura, // Request
          array('nom_o_raz_soc', 'rfc', 'lad_fij', 'tel_fij', 'ext', 'lad_mov', 'tel_mov', 'calle', 'no_ext', 'no_int', 'pais', 'ciudad', 'col', 'del_o_munic', 'cod_post', 'corr') // Nombre de los campos en la BD
         ); 
        $factura->updated_at_fact  = Auth::user()->email_registro;
      }
      $factura->est_fact = config('app.pendiente');
      $factura->save();
      DB::commit();
      return $factura;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}