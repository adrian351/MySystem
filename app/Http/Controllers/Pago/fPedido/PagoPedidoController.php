<?php
namespace App\Http\Controllers\Pago\fPedido;
use App\Exports\almacen\pedido\generarReporteExport;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\pago\fPedido\UpdatePagoRequest;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;
use App\Repositories\pago\PagoRepositories;
use Illuminate\Support\Facades\Auth;

class PagoPedidoController extends Controller {
  protected $serviceCrypt;
  protected $pedidoActivoRepo;
  protected $pagoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PedidoActivoRepositories $pedidoActivoRepositories, PagoRepositories $pagoRepositories) {
    $this->serviceCrypt     = $serviceCrypt;
    $this->pedidoActivoRepo = $pedidoActivoRepositories;
    $this->pagoRepo         = $pagoRepositories;
  }
  public function index(Request $request) {
    $pedidos =  \App\Models\Pedido::withCount(['pagos AS mont_pagado' => function ($query) {
                      $query->select(\DB::raw("SUM(mont_de_pag)"))->where('estat_pag', config('app.aprobado'));
                    }
                  ])
                  ->asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)
                  ->buscar($request->opcion_buscador, $request->buscador)
                  ->orderBy('id', 'DESC')
                  ->paginate($request->paginador);

    return view('pago.fPedido.fpe_index', compact('pedidos'));
  }
  public function create($id_pedido) {
    $pedido         = $this->pedidoActivoRepo->pedidoAsignadoFindOrFailById($id_pedido, ['pagos']);
    $pagos          = $this->pedidoActivoRepo->getPagosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $mont_pag_aprov =  $this->pedidoActivoRepo->getMontoDePagosAprobados($pedido);
    return view('pago.fPedido.fpe_create', compact('pedido', 'pagos', 'mont_pag_aprov'));
  }
  public function show($id_pago) {
    $pago   = $this->pagoRepo->getPagoFindOrFailById($id_pago, ['pedido'], null);
    $pedido = $pago->pedido()->firstOrFail();
    return view('pago.fPedido.pago.pag_show', compact('pago', 'pedido'));
  }
  public function edit($id_pago) {
    $pago = $this->pagoRepo->getPagoFindOrFailById($id_pago, ['pedido'], config('app.rechazado'));
    $pedido = $pago->pedido()->firstOrFail();
    return view('pago.fPedido.pago.pag_edit', compact('pago', 'pedido'));
  }
  public function update(UpdatePagoRequest $request, $id_pago) {
    $pago = $this->pagoRepo->updateFpedido($request, $id_pago);
    toastr()->success('¡Pago actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return redirect(route('pago.fPedido.create', $this->serviceCrypt->encrypt($pago->pedido->id)));
  }
  public function generarCodigo($id_pedido) {
    $pedido         = $this->pedidoActivoRepo->pedidoAsignadoFindOrFailById($id_pedido, ['pagos']);
    $pagos          = $this->pedidoActivoRepo->getPagosPedidoPagination($pedido, (object) ['paginador' => 99999999, 'opcion_buscador' => null]);
    $mont_pag_aprov =  $this->pedidoActivoRepo->getMontoDePagosAprobados($pedido);
    return view('pago.fPedido.fpe_generarCodigo', compact('pedido', 'pagos', 'mont_pag_aprov'));
  }
  public function generarReporte() {
    return (new \App\Exports\pago\fPedido\generarReporteDePagoExport)->download('ReporteDePagos-'.date('Y-m-d').'.xlsx');
  }
}