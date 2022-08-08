<?php
namespace App\Http\Controllers\Pago\Individual;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\pago\individual\StorePagoRequest;
use App\Http\Requests\pago\individual\StorePagoCodigoRequest;
use App\Http\Requests\pago\individual\UpdatePagoRequest;
// Repositories
use App\Repositories\pago\PagoRepositories;

class PagoController extends Controller {
  protected $pagoRepo;
  public function __construct(PagoRepositories $pagoRepositories) { 
    $this->pagoRepo    = $pagoRepositories;
  }
  public function index(Request $request) {
    $pagos =  $this->pagoRepo->getPagination($request);
    return view('pago.individual.ind_index', compact('pagos'));
  }
  public function store(StorePagoRequest $request, $id_pedido) {
    $this->pagoRepo->store($request, $id_pedido);
    toastr()->success('¡Pago registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function storeCodigo(StorePagoCodigoRequest $request, $id_pedido) {
    $request->not = 'Comentario del sistema: Primero se genera factura y después se carga el comprobante de pago.';
    $this->pagoRepo->store($request, $id_pedido);
    toastr()->success('¡Código generado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_pago) {
    $pago   = $this->pagoRepo->getPagoFindOrFailById($id_pago, ['pedido'], null);
    $pedido = $pago->pedido()->firstOrFail();
    return view('pago.individual.ind_show', compact('pago', 'pedido'));
  }
  public function edit($id_pago) {
    $pago           = $this->pagoRepo->getPagoFindOrFailById($id_pago, ['pedido'], null);
    $pedido         = $pago->pedido()->with(['pagos'])->firstOrFail();
    $mont_pag_aprov = $this->pagoRepo->getMontoDePagosAprobados($pedido);
    $pagos =  $pedido->pagos()->with(['usuario'])->paginate(99999999);
    return view('pago.individual.ind_edit', compact('pago', 'pagos', 'pedido', 'mont_pag_aprov'));
  }
  public function update(UpdatePagoRequest $request, $id_pago) {
    $this->pagoRepo->update($request, $id_pago);
    toastr()->success('¡Pago actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_pago) {
    $this->pagoRepo->destroy($id_pago);
    toastr()->success('¡Pago eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function marcarComoFacturado($id_pago) {
    $this->pagoRepo->marcarComoFacturado($id_pago);
    toastr()->success('¡Pago marcado como facturado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }

  public function generarReporte(Request $request) {
    return (new \App\Exports\pago\fPedido\reporteDePagoIndividualExport(
      $request->fecha_inicio,
      $request->fecha_fin,
      $request->fecha
    ))->download('ReporteDePagos-'.date('Y-m-d').'.xlsx');
  }
}