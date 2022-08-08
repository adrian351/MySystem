<?php
namespace App\Http\Controllers\Produccion\PedidoActivo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\produccion\pedidoActivo\UpdatePedidoActivoRequest;
use App\Http\Requests\produccion\pedidoActivo\UpdatePedidoActivoArmadoRequest;

// Repositories
use App\Repositories\produccion\pedidoActivo\PedidoActivoRepositories;
use App\Repositories\produccion\pedidoActivo\armadoPedidoActivo\ArmadoPedidoActivoRepositories;
use App\Repositories\venta\pedidoActivo\codigoQR\GenerarQRRepositories;

// use App\Repositories\sistema\actividad\ActividadRepositories;
// use App\Models\PedidoArmadoTieneDireccion;
use App\Repositories\servicio\archivoGenerado\ArchivoGeneradoRepositories;

// servicios 
use App\Repositories\servicio\crypt\ServiceCrypt;
class PedidoActivoController extends Controller {
  protected $pedidoActivoRepo;
  protected $armadoPedidoActivoRepo;
  protected $generarQRRepo;
  protected $serviceCrypt;
  // protected $actividadRepositories;


  public function __construct(ServiceCrypt $serviceCrypt, PedidoActivoRepositories $PedidoActivoRepositories, ArmadoPedidoActivoRepositories $armadoPedidoActivoRepositories, GenerarQRRepositories $generarQRRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->pedidoActivoRepo         = $PedidoActivoRepositories;
    $this->armadoPedidoActivoRepo   = $armadoPedidoActivoRepositories;
    $this->generarQRRepo            = $generarQRRepositories;
    // $this->actividadRepo                = $actividadRepositories;
  }
  public function index(Request $request, $opc_consulta = null) {
    $pedidos = $this->pedidoActivoRepo->getPagination($request, ['usuario', 'unificar'], $opc_consulta);
    $pen = $this->pedidoActivoRepo->getPendientes();
    return view('produccion.pedido.pedido_activo.pedAct_index', compact('pedidos', 'pen'));
  }

  // public function notifi(Request $request) {
  //   $actividad = $this->actividadRepo->onlyActividades($request);
  //   $direccion = $this->direcciones();
  //   return view('produccion.pedido.notificacion.notifi', compact('actividad', 'direccion'));
  // }


  public function show(Request $request, $id_pedido) {
    $pedido                        = $this->pedidoActivoRepo->pedidoActivoProduccionFindOrFailById($id_pedido, ['usuario', 'unificar', 'archivos'], 'show');
    $unificados                    = $pedido->unificar()->paginate(99999999);
    $archivos                      = $pedido->archivos()->paginate(99999999);
    $armados                       = $this->pedidoActivoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_terminados_produccion = $this->armadoPedidoActivoRepo->armadosTerminadosProduccion($pedido->id, [config('app.en_almacen_de_salida'), config('app.en_ruta'), config('app.entregado'), config('app.sin_entrega_por_falta_de_informacion'), config('app.intento_de_entrega_fallido')]);
    return view('produccion.pedido.pedido_activo.pedAct_show', compact('pedido', 'unificados', 'archivos', 'armados', 'armados_terminados_produccion'));
  }
  public function edit(Request $request, $id_pedido) {
    $pedido                         = $this->pedidoActivoRepo->pedidoActivoProduccionFindOrFailById($id_pedido, ['unificar'], 'edit');
    $unificados                     = $pedido->unificar()->paginate(99999999);
    $armados                        = $this->pedidoActivoRepo->getArmadosPedidoPaginate($pedido, $request);
    $armados_terminados_produccion  = $this->armadoPedidoActivoRepo->armadosTerminadosProduccion($pedido->id, [config('app.en_almacen_de_salida'), config('app.en_ruta'), config('app.entregado'), config('app.sin_entrega_por_falta_de_informacion'), config('app.intento_de_entrega_fallido')]);
    $cant_armados_estatus_produccion = $this->armadoPedidoActivoRepo->getEstatusArmado($pedido->id, [config('app.productos_completos'), config('app.en_produccion')]);
    return view('produccion.pedido.pedido_activo.pedAct_edit', compact('pedido', 'unificados', 'armados', 'armados_terminados_produccion', 'cant_armados_estatus_produccion'));
  }
  public function update(UpdatePedidoActivoRequest $request, $id_pedido) {
    $pedido = $this->pedidoActivoRepo->update($request, $id_pedido);
    toastr()->success('¡Pedido actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    if($pedido->estat_produc == config('app.en_almacen_de_salida_terminado')) {
      return redirect(route('produccion.pedidoActivo.index'));
    }
    return back();
  }
  public function generarOrdenDeProduccion($id_pedido) {
    $pedido   = $this->pedidoActivoRepo->pedidoActivoProduccionFindOrFailById($id_pedido, ['usuario'=> function ($query) {
      $query->select('id', 'nom', 'email_registro');
    }, 'unificar' => function ($query) {
      $query->select('num_pedido');
    }, 'archivos'], 'edit');
    
    $archivos = $pedido->archivos->count();

    $codigoQRAlmacen = $this->generarQRRepo->qr($pedido->id, 'Almacén');
    $codigoQRProduccion = $this->generarQRRepo->qr($pedido->id, 'Producción');
    $codigoQRLogistica = $this->generarQRRepo->qr($pedido->id, 'Logística');
      
    $armados  = $pedido->armados()->with(['productos'=> function ($query) {
      $query->with('sustitutos');
    }, 'direcciones'=> function ($query) {
      $query->select('cant', 'tip_tarj_felic', 'mens_dedic', 'pedido_armado_id', 'caj');
    }])->get();

    $orden_de_produccion  = \PDF::loadView('produccion.pedido.pedido_activo.export.ordenDeProduccion', compact('pedido', 'armados', 'archivos', 'codigoQRAlmacen', 'codigoQRProduccion', 'codigoQRLogistica'))->setPaper('a4', 'landscape');
    return $orden_de_produccion->stream();
  }

  // parche para traer las direciones
  // public function direcciones(){
  // return  PedidoArmadoTieneDireccion::orderBy('id', 'DESC')->get(['id', 'cod', 'deleted_at']);

  // }

  public function reporteProduccionExport(ArchivoGeneradoRepositories $archivoGeneradoRepo) {
    return (new \App\Exports\produccion\reporteProduccionExport)->download('Pedidos-'.date('Y-m-d').'.xlsx');
  }

  public function asignarRackArmados(UpdatePedidoActivoArmadoRequest $request, $id_pedido){
    $pedido = $this->pedidoActivoRepo->asignarRackArmados($request, $id_pedido); // cambiar estatus a todoso los armados 
    toastr()->success('¡Armados terminados exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    if($pedido->estat_produc == config('app.en_almacen_de_salida_terminado')) {
      toastr()->success('¡Pedido terminado exitosamente!');
      return redirect(route('produccion.pedidoActivo.index', $this->serviceCrypt->encrypt($id_pedido)));
    }
    return back();
  }
}
