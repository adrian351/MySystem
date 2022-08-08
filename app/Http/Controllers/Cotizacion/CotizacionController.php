<?php
namespace App\Http\Controllers\Cotizacion;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\cotizacion\StoreCotizacionRequest;
use App\Http\Requests\cotizacion\UpdateIvaCotizacionRequest;
use App\Http\Requests\cotizacion\UpdateComisionCotizacionRequest;
use App\Http\Requests\cotizacion\UpdateCotizacionRequest;
//Repositories
use App\Repositories\cotizacion\CotizacionRepositories;
use App\Repositories\cotizacion\AprobarCotizacionRepositories;
use App\Repositories\usuario\UsuarioRepositories;
use App\Repositories\armado\ArmadoRepositories;
use App\Repositories\marca\MarcaRepositories;
use App\Models\Armado;

// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class CotizacionController extends Controller {
  protected $serviceCrypt;
  protected $cotizacionRepo;
  protected $aprobarCotizacionRepo;
  protected $usuarioRepo;
  protected $armadoRepo;
  protected $marcaRepo;
  public function __construct(ServiceCrypt $serviceCrypt, CotizacionRepositories $cotizacionRepositories, AprobarCotizacionRepositories $aprobarCotizacionRepositories, UsuarioRepositories $usuarioRepositories, ArmadoRepositories $armadoRepositories, MarcaRepositories $marcaRepositories) {
    $this->serviceCrypt           = $serviceCrypt;
    $this->cotizacionRepo         = $cotizacionRepositories;
    $this->aprobarCotizacionRepo  = $aprobarCotizacionRepositories;
    $this->usuarioRepo            = $usuarioRepositories;
    $this->armadoRepo             = $armadoRepositories;
    $this->marcaRepo      = $marcaRepositories;
  }
  public function index(Request $request) {
    $cotizaciones = $this->cotizacionRepo->getPagination($request);
    return view('cotizacion.cot_index', compact('cotizaciones'));
  }
  public function create() {
    $clientes_list  = $this->usuarioRepo->getAllClientesIdPlunk();
    return view('cotizacion.cot_create', compact('clientes_list'));
  }
  public function store(StoreCotizacionRequest $request) {
    // dd($request);
    $cotizacion = $this->cotizacionRepo->store($request);
    if(auth()->user()->can('cotizacion.edit')) {
      toastr()->success('¡Cotización registrada exitosamente ahora puedes registrar sus armados!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return redirect(route('cotizacion.edit', $this->serviceCrypt->encrypt($cotizacion->id))); 
    }
    toastr()->success('¡Cotización registrada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_cotizacion) {
    $cotizacion = $this->cotizacionRepo->cotizacionAsignadoFindOrFailById($id_cotizacion, ['armados', 'cliente'], null);
    $armados    = $cotizacion->armados()->with('productos')->paginate(99999999);
    return view('cotizacion.cot_show', compact('cotizacion', 'armados'));
  }
  public function showPorNumPedido($num_pedido) {
    $cotizacion = $this->cotizacionRepo->cotizacionFindOrFailByNumPedido($num_pedido, ['armados', 'cliente'], null);
    $armados    = $cotizacion->armados()->with('productos')->paginate(99999999);
    return view('cotizacion.cot_show', compact('cotizacion', 'armados'));
  }
  public function edit($id_cotizacion) {
    $cotizacion   = $this->cotizacionRepo->cotizacionAsignadoFindOrFailById($id_cotizacion, ['armados', 'cliente'], config('app.abierta'));
    $armados      = $cotizacion->armados()->with('productos', 'direcciones')->paginate(99999999);
    $armados_list = $this->armadoRepo->getAllArmados();
    // pasamos las marcas
    $marcas_list = $this->marcaRepo->Only_Marcas();

    return view('cotizacion.cot_edit', compact('cotizacion', 'armados', 'armados_list', 'marcas_list'));
  }
  public function update(UpdateCotizacionRequest $request, $id_cotizacion) {
    $this->cotizacionRepo->update($request, $id_cotizacion);
    toastr()->success('¡Cotización actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_cotizacion) {
    $this->cotizacionRepo->destroy($id_cotizacion);
    toastr()->success('¡Cotización eliminada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function updateIva(UpdateIvaCotizacionRequest $request, $id_cotizacion) {
    $this->cotizacionRepo->updateIva($request, $id_cotizacion);
    toastr()->success('¡IVA actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function updateComision(UpdateComisionCotizacionRequest $request, $id_cotizacion) {
    $this->cotizacionRepo->updateComision($request, $id_cotizacion);
    toastr()->success('¡Comisión agregada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function generar($id_cotizacion) {
  //  $id_cotizacion = $this->serviceCrypt->decrypt($id_cotizacion);
  //  return (new \App\Exports\cotizacion\generarCotizacionExport($id_cotizacion))->download('Cotización-'.date('Y-m-d').'-'.time().'.pdf', \Maatwebsite\Excel\Excel::DOMPDF);

  //  toastr()->success('¡La cotización se esta generando una vez que haya terminado se mostrara en la barra superior!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
  //  return back();

    $cotizacion     = $this->cotizacionRepo->cotizacionAsignadoFindOrFailById($id_cotizacion, ['armados', 'cliente'], config('app.abierta.aprobada'));
    $armados        = $cotizacion->armados()->with('productos', 'direcciones')->get();

    $corizacion_pdf = \PDF::loadView('cotizacion.export.generarCotizacion', compact('cotizacion', 'armados'))->setPaper('a4', 'landscape');
    
    return $corizacion_pdf->stream(); // Visualizar
  //  return $corizacion_pdf->download('Cotización-'$cotizacion->serie.'.pdf'); // Descargar
  }
  public function clonar($id_cotizacion) {
    $this->cotizacionRepo->clonar($id_cotizacion);
    toastr()->success('¡Cotización clonada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function aprobar($id_cotizacion) {
    $info = $this->aprobarCotizacionRepo->aprobar($id_cotizacion);
    if(auth()->user()->can('venta.pedidoActivo.edit')) {
      toastr()->success('¡Cotización aprobada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      toastr()->success('¡Pedido registrado exitosamente ahora puedes completar la información faltante!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return redirect(route('venta.pedidoActivo.edit', $this->serviceCrypt->encrypt($info->pedido->id))); 
    }
    toastr()->success('¡Se ha generado un pedido de esta cotización exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    toastr()->success('¡Cotización aprobada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return redirect(route('cotizacion.index')); 
  }
  public function cancelar($id_cotizacion) {
    $this->cotizacionRepo->cancelar($id_cotizacion);
    toastr()->success('¡Cotización cancelada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return redirect(route('cotizacion.index')); 
  }
}