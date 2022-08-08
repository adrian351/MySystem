<?php
namespace App\Http\Controllers\Cliente\Show;
use App\Http\Controllers\Controller;
// Models
use App\Models\Direccion;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\rolCliente\direccion\StoreDireccionRequest;
// Repositories
use App\Repositories\usuario\UsuarioRepositories;
use App\Repositories\rolCliente\direccion\DireccionRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class DireccionController extends Controller {
  protected $serviceCrypt;
  protected $usuarioRepo;
  protected $direccionRepo;
  public function __construct(ServiceCrypt $serviceCrypt, UsuarioRepositories $usuarioRepositories, DireccionRepositories $direccionRepositories) {
    $this->serviceCrypt   = $serviceCrypt;
    $this->usuarioRepo    = $usuarioRepositories;
    $this->direccionRepo  = $direccionRepositories;
  }
  public function index(Request $request, $id_cliente) {
    $cliente      = $this->usuarioRepo->usuarioAsignadoFindOrFailById($id_cliente, '2', ['direcciones']);
    $direcciones  = $cliente->direcciones()->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
    return view('cliente.show.direccion.sho_dir_index', compact('cliente', 'direcciones'));
  }
  public function store(StoreDireccionRequest $request, $id_cliente) {
    try { DB::beginTransaction();
      $direccion = new Direccion();
      $direccion = $this->direccionRepo->storeFields($direccion, $request);
      $direccion->user_id             = $this->serviceCrypt->decrypt($id_cliente);
      $direccion->created_at_direc    = Auth::user()->email_registro;
      $direccion->save();
      
      DB::commit();
      toastr()->success('¡Direccion registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return back();
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function show($id_direccion) {
    $direccion = $this->direccionRepo->getDireccionFindOrFail($id_direccion, ['usuario']);
    $cliente   = $direccion->usuario;
    return view('cliente.show.direccion.sho_dir_show', compact('cliente', 'direccion'));
  }
}