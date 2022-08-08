<?php
namespace App\Http\Controllers\Logistica\DireccionForaneo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\logistica\direccionLocal\UpdateEstatusDireccionRequest;
// Repositories
use App\Repositories\logistica\direccionLocal\DireccionLocalRepositories;
use App\Repositories\metodoDeEntrega\MetodoDeEntregaRepositories;
use App\Repositories\venta\pedidoActivo\codigoQR\GenerarQRRepositories;

class DireccionForaneoController extends Controller {
  protected $direccionLocalRepo;
  protected $comprobanteRepo;
  protected $generarQRRepo;
  public function __construct(DireccionLocalRepositories $direccionLocalRepositories, MetodoDeEntregaRepositories $metodoDeEntregaRepositories, GenerarQRRepositories $generarQRRepositories) {
    $this->direccionLocalRepo   = $direccionLocalRepositories;
    $this->metodoDeEntregaRepo  = $metodoDeEntregaRepositories;
    $this->generarQRRepo        = $generarQRRepositories;
  }
  public function index(Request $request) {
    $direcciones_foraneas = $this->direccionLocalRepo->getPagination($request, config('opcionesSelect.select_foraneo_local.Foráneo'), []);
    return view('logistica.pedido.direccion_foraneo.dirFor_index', compact('direcciones_foraneas'));
  }
  public function create($id_direccion) {
    $direccion          = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, config('opcionesSelect.select_foraneo_local.Foráneo'), [], 'edit', null);
    if($direccion->nom_ref_uno == null) { return abort(403, 'No se ha definido la persona que recibe este pedido.'); }
    $armado             = $direccion->armado;
    $metodos_de_entrega = $this->metodoDeEntregaRepo->getAllMetodosForaneoOLocalPluck('Foráneo');
    return view('logistica.pedido.direccion_local.comprobante.com_createSalida', compact('direccion', 'armado', 'metodos_de_entrega'));
  }
  public function show($id_direccion) {
    $direccion    = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, config('opcionesSelect.select_foraneo_local.Foráneo'), ['comprobantes', 'armado'], 'show', null);
    $comprobantes = $direccion->comprobantes;
    $armado       = $direccion->armado;
    return view('logistica.pedido.direccion_foraneo.dirFor_show', compact('direccion', 'comprobantes', 'armado'));
  }
  public function edit($id_direccion) {
    $direccion  = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, config('opcionesSelect.select_foraneo_local.Foráneo'), [], 'edit', true);
    $armado     = $direccion->armado;
    $productos  = $armado->productos()->with(['sustitutos', 'productos_original'])->get();
    return view('logistica.pedido.direccion_foraneo.dirFor_edit', compact('direccion', 'armado', 'productos'));
  }
  public function update(UpdateEstatusDireccionRequest $request, $id_direccion) {
    $direccion = $this->direccionLocalRepo->update($request, $id_direccion, config('opcionesSelect.select_foraneo_local.Foráneo'));
    toastr()->success('¡Dirección actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"

    if($direccion->armado->estat == config('app.productos_completos')){
      return redirect(route('logistica.direccionForaneo.index')); 
    }
    return back();
  }
  public function createEntrega($id_direccion) { 
    $direccion  = $this->direccionLocalRepo->direccionLocalFindOrFailById($id_direccion, config('opcionesSelect.select_foraneo_local.Foráneo'), [], 'edit', null);
    if($direccion->nom_ref_uno == null) { return abort(403, 'No se ha definido la persona que recibe este pedido.'); }
    $armado     = $direccion->armado()->with(['pedido'])->first();
    return view('logistica.pedido.direccion_local.comprobante.com_createEntrega', compact('direccion', 'armado'));
  }
  public function generarReporte() {
    return (new \App\Exports\logistica\pedido\direccionForaneo\foraneoExport)->download('DireccionesForaneas-'.date('Y-m-d').'.xlsx');
  }
}