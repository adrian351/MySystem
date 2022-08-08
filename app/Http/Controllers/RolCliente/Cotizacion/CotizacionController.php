<?php
namespace App\Http\Controllers\RolCliente\Cotizacion;
use App\Http\Controllers\Controller;
// Models
use App\Models\Cotizacion;
// Request
use Illuminate\Http\Request;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;

class CotizacionController extends Controller {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt   = $serviceCrypt;
  }
  public function index(Request $request) {
    $cotizaciones = Cotizacion::where('user_id', Auth::user()->id)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
    return view('rolCliente.cotizacion.cot_index', compact('cotizaciones'));
  }
  public function show($id_cotizacion) {
    $id_cotizacion = $this->serviceCrypt->decrypt($id_cotizacion);
    $cotizacion = Cotizacion::with('armados')->findOrFail($id_cotizacion);
    $armados = $cotizacion->armados()->paginate(99999999);
    return view('rolCliente.cotizacion.cot_show', compact('cotizacion', 'armados'));
  }
}