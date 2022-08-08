<?php
namespace App\Http\Controllers\RolCliente\Direccion;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\rolCliente\direccion\StoreDireccionRequest;
// Repositories
use App\Repositories\rolCliente\direccion\DireccionRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class DireccionController extends Controller {
  protected $serviceCrypt;
  protected $direccionRepo;
  public function __construct(ServiceCrypt $serviceCrypt, DireccionRepositories $direccionRepositories) { // Interfaz para implementar solo [metodos] o [metodos y cache] definido en AppServiceProvider
    $this->serviceCrypt   = $serviceCrypt;
    $this->direccionRepo  = $direccionRepositories;
  }
  public function index(Request $request) {
    $direcciones = $this->direccionRepo->getPagination($request);
    return view('rolCliente.direccion.dir_index', compact('direcciones'));
  }
  public function create() {
    return view('rolCliente.direccion.dir_create');
  }
  public function store(StoreDireccionRequest $request) {
    $this->direccionRepo->store($request);
    toastr()->success('¡Dirección registrada exitosamente! RECUERDA ASIGNARLA A LOS PRODUCTOS DE TU PEDIDO'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_direccion) {
    $direccion = $this->direccionRepo->getDireccionFindOrFail($id_direccion, []);
    return view('rolCliente.direccion.dir_show', compact('direccion'));
  }
  public function edit($id_direccion) {
    $direccion = $this->direccionRepo->getDireccionFindOrFail($id_direccion, []);
    return view('rolCliente.direccion.dir_edit', compact('direccion'));
  }
  public function update(StoreDireccionRequest $request, $id_direccion) {
    $this->direccionRepo->update($request, $id_direccion);
    toastr()->success('¡Dirección actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_direccion) {
    $this->direccionRepo->destroy($id_direccion);
    toastr()->success('¡Dirección eliminada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function getDireccionFind(Request $request, $id_direccion) {
    if($request->ajax()) {
      $direccion = $this->direccionRepo->getDireccionFind($id_direccion);
      return response()->json($direccion);
    } 
  }
  public function getDireccion(Request $request, $id_direccion) {
    if($request->ajax()) {
      $direccion = $this->direccionRepo->getDireccion($id_direccion);
      return response()->json($direccion);
    } 
  }
}