<?php
namespace App\Http\Controllers\RolCliente\Pago;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\rolCliente\pago\StorePagoRequest;
use App\Http\Requests\pago\fPedido\UpdatePagoRequest;
// Repositories
use App\Repositories\rolCliente\pago\PagoClienteRepositories;
use App\Repositories\pago\PagoRepositories;
use App\Repositories\rolCliente\pedido\PedidoClienteRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class PagoController extends Controller {
  protected $serviceCrypt;
  protected $pagoClienteRepo;
  protected $pagoRepo;
  protected $pedidoClienteRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PagoClienteRepositories $pagoClienteRepositories, PagoRepositories $pagoRepositories, PedidoClienteRepositories $pedidoClienteRepositories) {
    $this->serviceCrypt       = $serviceCrypt;
    $this->pagoClienteRepo    = $pagoClienteRepositories;
    $this->pagoRepo           = $pagoRepositories;
    $this->pedidoClienteRepo  = $pedidoClienteRepositories;
  }
  public function index(Request $request) {
    $pagos = $this->pagoClienteRepo->getPagination($request);
    return view('rolCliente.pago.pag_index', compact('pagos'));
  }
  public function create() {
    $num_pedidos = $this->pedidoClienteRepo->getPedidosSinPagarClientePluck();
    return view('rolCliente.pago.pag_create', compact('num_pedidos'));
  }
  public function store(StorePagoRequest $request) {
    $this->pagoRepo->store($request, $this->serviceCrypt->encrypt($request->numero_de_pedido));
    toastr()->success('¡Pago registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_pago) {
    $pago  = $this->pagoClienteRepo->getPagoFindOrFailById($id_pago, ['pedido'], null);
    $pedido = $pago->pedido()->firstOrFail();
    return view('rolCliente.pago.pag_show', compact('pago', 'pedido'));
  }
  public function edit($id_pago) {
    $pago = $this->pagoClienteRepo->getPagoFindOrFailById($id_pago, ['pedido'], config('app.rechazado'));
    $pedido = $pago->pedido()->firstOrFail();
    return view('rolCliente.pago.pag_edit', compact('pago', 'pedido'));
  }
  public function update(UpdatePagoRequest $request, $id_pago) {
    $this->pagoRepo->updateFpedido($request, $id_pago);
    toastr()->success('¡Pago actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return redirect(route('rolCliente.pago.index'));
  }
}