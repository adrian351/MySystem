<?php
namespace App\Http\Controllers\Cliente\Show;
use App\Http\Controllers\Controller;
// Models
use App\Models\DatoFiscal;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\rolCliente\datoFiscal\StoreDatoFiscalRequest;
// Repositories
use App\Repositories\usuario\UsuarioRepositories;
use App\Repositories\rolCliente\datoFiscal\DatoFiscalRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class DatoFiscalController extends Controller {
  protected $serviceCrypt;
  protected $usuarioRepo;
  protected $datoFiscalRepo;
  public function __construct(ServiceCrypt $serviceCrypt, UsuarioRepositories $usuarioRepositories, DatoFiscalRepositories $datoFiscalRepositories) {
    $this->serviceCrypt   = $serviceCrypt;
    $this->usuarioRepo    = $usuarioRepositories;
    $this->datoFiscalRepo = $datoFiscalRepositories;
  }
  public function index(Request $request, $id_cliente) {
    $cliente        = $this->usuarioRepo->usuarioAsignadoFindOrFailById($id_cliente, '2', ['datosFiscales']);
    $datos_fiscales = $cliente->datosFiscales()->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
    return view('cliente.show.datoFiscal.sho_dfi_index', compact('cliente', 'datos_fiscales'));
  }
  public function store(StoreDatoFiscalRequest $request, $id_cliente) {
    try { DB::beginTransaction();
      $dato_fiscal                      = new DatoFiscal();
      $dato_fiscal                      = $this->datoFiscalRepo->storeFields($dato_fiscal, $request);
      $dato_fiscal->user_id             = $this->serviceCrypt->decrypt($id_cliente);
      $dato_fiscal->created_at_dat_fisc = Auth::user()->email_registro;
      $dato_fiscal->save();
      DB::commit();
      toastr()->success('¡Dato fiscal registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return back();
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function show($id_dato_fiscal) {
    $dato_fiscal = $this->datoFiscalRepo->getDatoFiscalFindOrFail($id_dato_fiscal, ['usuario']);
    $cliente     = $dato_fiscal->usuario;
    return view('cliente.show.datoFiscal.sho_dfi_show', compact('cliente', 'dato_fiscal'));
  }
}