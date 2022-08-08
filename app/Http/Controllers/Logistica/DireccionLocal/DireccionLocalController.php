<?php
namespace App\Http\Controllers\Logistica\DireccionLocal;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\logistica\direccionLocal\StoreComprobanteDeSalidaRequest;
use App\Http\Requests\logistica\direccionLocal\StoreComprobanteDeEntregaRequest;
use App\Http\Requests\logistica\direccionLocal\UpdateEstatusDireccionRequest;
// Repositories
use App\Repositories\logistica\direccionLocal\DireccionLocalRepositories;
use App\Repositories\metodoDeEntrega\MetodoDeEntregaRepositories;
use App\Repositories\venta\pedidoActivo\codigoQR\GenerarQRRepositories;

class DireccionLocalController extends Controller {
  protected $direccionLocalRepo;
  protected $comprobanteRepo;
  protected $generarQRRepo;
  public function __construct(DireccionLocalRepositories $direccionLocalRepositories, MetodoDeEntregaRepositories $metodoDeEntregaRepositories, GenerarQRRepositories $generarQRRepositories) {
    $this->direccionLocalRepo   = $direccionLocalRepositories;
    $this->metodoDeEntregaRepo  = $metodoDeEntregaRepositories;
    $this->generarQRRepo        = $generarQRRepositories;
  }
  public function index(Request $request) {
    $direcciones_locales = $this->direccionLocalRepo->getPagination($request, config('opcionesSelect.select_foraneo_local.Local'), []);
    return view('logistica.pedido.direccion_local.dirLoc_index', compact('direcciones_locales'));
  }
  public function create($id_direccion) {
    $direccion          = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, config('opcionesSelect.select_foraneo_local.Local'), [], 'edit', null);
    if($direccion->nom_ref_uno == null) { return abort(403, 'No se ha definido la persona que recibe este pedido.'); }
    $armado             = $direccion->armado;
    $metodos_de_entrega = $this->metodoDeEntregaRepo->getAllMetodosForaneoOLocalPluck('Local');
    return view('logistica.pedido.direccion_local.comprobante.com_createSalida', compact('direccion', 'armado', 'metodos_de_entrega'));
  }
  public function store(StoreComprobanteDeSalidaRequest $request, $id_direccion) {
    $direccion = $this->direccionLocalRepo->store($request, $id_direccion);
    return $direccion;
  }
  public function createEntrega($id_direccion) {
    $direccion  = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, config('opcionesSelect.select_foraneo_local.Local'), [], 'edit', null);
    if($direccion->nom_ref_uno == null) { return abort(403, 'No se ha definido la persona que recibe este pedido.'); }
    $armado     = $direccion->armado;
    return view('logistica.pedido.direccion_local.comprobante.com_createEntrega', compact('direccion', 'armado'));
  }
  public function storeEntrega(StoreComprobanteDeEntregaRequest $request, $id_direccion) {
    $direccion = $this->direccionLocalRepo->storeEntrega($request, $id_direccion);
    return $direccion;
  }
  public function show($id_direccion) {
    $direccion    = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, config('opcionesSelect.select_foraneo_local.Local'), ['comprobantes', 'armado'], 'show', null);
    $comprobantes = $direccion->comprobantes;
    $armado       = $direccion->armado;
    return view('logistica.pedido.direccion_local.dirLoc_show', compact('direccion', 'comprobantes', 'armado'));
  }
  public function edit($id_direccion) {
    $direccion  = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, config('opcionesSelect.select_foraneo_local.Local'), [], 'edit', true);
    $armado     = $direccion->armado;
    $productos  = $armado->productos()->with(['sustitutos', 'productos_original'])->get();
    return view('logistica.pedido.direccion_local.dirLoc_edit', compact('direccion', 'armado', 'productos'));
  }
  public function update(UpdateEstatusDireccionRequest $request, $id_direccion) {
    $direccion = $this->direccionLocalRepo->update($request, $id_direccion, config('opcionesSelect.select_foraneo_local.Local'));
    toastr()->success('¡Dirección actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"

    if($direccion->armado->estat == config('app.productos_completos')){
      return redirect(route('logistica.direccionLocal.index')); 
    }
    return back();
  }
  public function metodoDeEntrega(Request $request, $foraneo_o_local) {
    if($request->ajax()) {
      $metodo_de_entrega = $this->metodoDeEntregaRepo->getAllMetodosForaneoOLocalPluck($foraneo_o_local);
      return $metodo_de_entrega;
    }
  }
  public function metodoDeEntregaEspecifico(Request $request, $metodo_de_entrega) {
    if($request->ajax()) {
      $metodo_de_entrega = $this->metodoDeEntregaRepo->metodoFindOrFailByNombreMetodo($metodo_de_entrega, ['metodosDeEntregaEspecificos']);
      return $metodo_de_entrega->metodosDeEntregaEspecificos()->pluck('nom_met_ent_esp', 'nom_met_ent_esp');
    }
  }
  public function generarComprobanteDeEntrega($id_direccion, $for_loc) { // config('opcionesSelect.select_foraneo_local.Local')
    $direccion  = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, $for_loc, ['armado'], 'show', null);
    $armado     = $direccion->armado()->with('pedido')->first();
    $pedido     = $armado->pedido;

    if($pedido->estat_pag != config('app.pagado')) {
      return abort('404', 'IMPORTANTE: Este pedido aun no sido pagado.');
    }

    $codigoQRDComprobanteDeSalida   = $this->generarQRRepo->qr($direccion->id, 'Comprobante de salida', $for_loc);
    $codigoQRDComprobanteDeEntrega  = $this->generarQRRepo->qr($direccion->id, 'Comprobante de entrega', $for_loc);

    $comprobante_de_entrega  = \PDF::loadView('logistica.pedido.pedido_activo.export.comprobanteDeEntrega', compact('pedido', 'direccion', 'armado', 'codigoQRDComprobanteDeSalida', 'codigoQRDComprobanteDeEntrega'));
    return $comprobante_de_entrega->stream();
//  return $comprobante_de_entrega->download('OrdenDeProduccionAlmacen-'$pedido->num_pedido.'.pdf'); // Descargar
  }
  public function generarReporte() {
    return (new \App\Exports\logistica\pedido\direccionLocal\localExport)->download('DireccionesLocales-'.date('Y-m-d').'.xlsx');
  }
}