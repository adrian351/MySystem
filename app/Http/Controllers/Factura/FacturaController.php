<?php
namespace App\Http\Controllers\Factura;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\factura\StoreFacturaRequest;
use App\Http\Requests\factura\UpdateFacturaRequest;
use App\Http\Requests\factura\StoreArchivosRequest;
// Repositories
use App\Repositories\factura\FacturaRepositories;
use App\Repositories\usuario\UsuarioRepositories;

class FacturaController extends Controller {
  protected $facturaRepo;
  protected $usuarioRepo;
  public function __construct(FacturaRepositories $facturaRepositories, UsuarioRepositories $usuarioRepositories) {
    $this->facturaRepo  = $facturaRepositories;
    $this->usuarioRepo  = $usuarioRepositories;
  }
  public function index(Request $request) {
    $facturas = $this->facturaRepo->getPagination($request);
    return view('factura.fac_index', compact('facturas'));
  }
  public function create() {
    $clientes = $this->usuarioRepo->getAllClientesIdPlunk();
    return view('factura.fac_create', compact('clientes'));
  }
  public function store(StoreFacturaRequest $request) {
    $this->facturaRepo->store($request);
    toastr()->success('¡Factura solicitada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_factura) {
    $factura = $this->facturaRepo->getFacturaFindOrFailById($id_factura, ['usuario', 'pago'], null);
    $pago = $factura->pago()->with('pedido')->first();
    return view('factura.fac_show', compact('factura', 'pago'));
  }
  public function edit($id_factura) {
    $factura = $this->facturaRepo->getFacturaFindOrFailById($id_factura, [], config('app.facturado'));
    return view('factura.fac_edit', compact('factura'));
  }
  public function update(UpdateFacturaRequest $request, $id_factura) {
    $this->facturaRepo->update($request, $id_factura);
    toastr()->success('¡Factura actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_factura) {
    $this->facturaRepo->destroy($id_factura);
    toastr()->success('¡Factura eliminada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function subirArchivos($id_factura) {
    $factura = $this->facturaRepo->getFacturaFindOrFailById($id_factura, [], null);
    return view('factura.fac_subirArchivos', compact('factura'));
  }
  public function updateSubirArchivos(StoreArchivosRequest $request, $id_factura) {
    $factura = $this->facturaRepo->updateSubirArchivos($request, $id_factura);
    toastr()->success('¡Archivos cargados exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function generarReporte(Request $request) {
    return (new \App\Exports\factura\reporteFacturadoExport($request->fecha))->download('ReporteFacturacion-'.date('Y-m-d').'.xlsx');
  }
}