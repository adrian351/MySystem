<?php
namespace App\Http\Controllers\Proveedor;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\proveedor\StoreProveedorRequest;
use App\Http\Requests\proveedor\UpdateProveedorRequest;
use App\Http\Requests\proveedor\UpdateValidadoProveedorRequest;
// Repositories
use App\Repositories\proveedor\ProveedorRepositories;

class ProveedorController extends Controller {
  protected $proveedorRepo;
  public function __construct(ProveedorRepositories $proveedorRepositories) {
    $this->proveedorRepo = $proveedorRepositories;
  }
  public function index(Request $request) {
    $proveedores = $this->proveedorRepo->getPagination($request);
    return view('proveedor.pro_index', compact('proveedores'));
  }
  public function create() {
    return view('proveedor.pro_create');
  }
  public function store(StoreProveedorRequest $request) {
    $this->proveedorRepo->store($request);
    toastr()->success('¡Proveedor registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show(Request $request, $id_proveedor) {
    $proveedor = $this->proveedorRepo->proveedorAsignadoFindOrFailById($id_proveedor, 'contactos');
    $contactos = $this->proveedorRepo->getContactosProveedor($proveedor, $request);
    $productos = $proveedor->productos()->paginate(99999999);
    return view('proveedor.pro_show', compact('proveedor', 'contactos', 'productos'));
  }
  public function edit(Request $request, $id_proveedor) {
    $proveedor = $this->proveedorRepo->proveedorAsignadoFindOrFailById($id_proveedor, 'contactos');
    $contactos = $this->proveedorRepo->getContactosProveedor($proveedor, $request);
    $productos = $proveedor->productos()->paginate(99999999);
    return view('proveedor.pro_edit', compact('proveedor', 'contactos', 'productos'));
  }
  public function update(UpdateProveedorRequest $request, $id_proveedor) {
    $this->proveedorRepo->update($request, $id_proveedor);
    toastr()->success('¡Proveedor actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_proveedor) {
    $this->proveedorRepo->destroy($id_proveedor);
    toastr()->success('¡Proveedor eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function updateValidado(UpdateValidadoProveedorRequest $request, $id_proveedor) {
    $this->proveedorRepo->updateValidado($request, $id_proveedor);
    toastr()->success('¡Proveedor actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}