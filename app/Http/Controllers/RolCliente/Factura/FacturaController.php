<?php
namespace App\Http\Controllers\RolCliente\Factura;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\rolCliente\factura\StoreFacturaRequest;
use App\Http\Requests\rolCliente\factura\UpdateFacturaRequest;
// Repositories
use App\Repositories\rolCliente\factura\FacturaClienteRepositories;
use App\Repositories\rolCliente\datoFiscal\DatoFiscalRepositories;
use App\Repositories\rolCliente\pago\PagoClienteRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class FacturaController extends Controller {
  protected $serviceCrypt;
  protected $facturaRepo;
  protected $datoFiscalRepo;
  protected $pagoClienteRepo;
  public function __construct(ServiceCrypt $serviceCrypt, FacturaClienteRepositories $facturaRepositories, DatoFiscalRepositories $datoFiscalRepositories, PagoClienteRepositories $pagoClienteRepositories) {
    $this->serviceCrypt     = $serviceCrypt;
    $this->facturaRepo      = $facturaRepositories;
    $this->datoFiscalRepo   = $datoFiscalRepositories;
    $this->pagoClienteRepo  = $pagoClienteRepositories;
  }
  public function index(Request $request) {
    $facturas = $this->facturaRepo->getPagination($request);
    return view('rolCliente.factura.fac_index', compact('facturas'));
  }
  public function create() {
    $datos_fiscales         = $this->datoFiscalRepo->getAllDatosFiscalesClientePluck();
  //  $codigos_de_facturacion = $this->pagoClienteRepo->getAllCodigosFacturaClientePluck();

      $codigos_de_facturacion = \App\Models\Pago::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
              ->where(function($query) {
                $query->where('est_fact', config('app.no_solicitada'))
                ->orwhere('est_fact', config('app.cancelado'));
              })
              ->whereYear('created_at', date('Y'))
              ->orderBy('cod_fact', 'ASC')
              ->get(['cod_fact', 'mont_de_pag']);

    return view('rolCliente.factura.fac_create', compact('datos_fiscales', 'codigos_de_facturacion'));
  }
  public function store(StoreFacturaRequest $request) {
    $this->facturaRepo->store($request);
    toastr()->success('¡Factura solicitada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_factura) {
    $factura  = $this->facturaRepo->getFacturaFindOrFail($id_factura, ['usuario', 'pago'], 'show');
    $pago     = $factura->pago;
    return view('rolCliente.factura.fac_show', compact('factura', 'pago'));
  }
  public function edit($id_factura) {
    $factura = $this->facturaRepo->getFacturaFindOrFail($id_factura, [], 'edit');
    return view('rolCliente.factura.fac_edit', compact('factura'));
  }
  public function update(UpdateFacturaRequest $request, $id_factura) {
    $this->facturaRepo->update($request, $id_factura);
    toastr()->success('¡Factura actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return redirect(route('rolCliente.factura.index')); 
  }
}