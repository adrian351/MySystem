<?php
namespace App\Http\Controllers\Proveedor\ContactoProveedor;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\proveedor\contactoProveedor\StoreContactoRequest;
use App\Http\Requests\proveedor\contactoProveedor\UpdateContactoRequest;
// Repositories
use App\Repositories\proveedor\contacto_proveedor\ContactoRepositories;
use App\Repositories\proveedor\ProveedorRepositories;

class ContactoController extends Controller {
  protected $contactoRepo;
  protected $proveedorRepo;
  public function __construct(ContactoRepositories $contactoRepositories, ProveedorRepositories $proveedorRepositories) {
    $this->contactoRepo = $contactoRepositories;
    $this->proveedorRepo = $proveedorRepositories;
  }
  public function create($id_proveedor) {
    $proveedor = $this->proveedorRepo->proveedorFindOrFailById($id_proveedor);
    return view('proveedor.contacto_proveedor.pro_conPro_create', compact('proveedor'));
  }
  public function store(StoreContactoRequest $request, $id_proveedor) {
    $this->contactoRepo->store($request, $id_proveedor);
    toastr()->success('¡Contacto registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_contacto) {
    $contacto = $this->contactoRepo->contactoFindOrFailById($id_contacto);
    return view('proveedor.contacto_proveedor.pro_conPro_show', compact('contacto'));
  }
  public function edit($id_contacto) {
    $contacto = $this->contactoRepo->contactoFindOrFailById($id_contacto);
    return view('proveedor.contacto_proveedor.pro_conPro_edit', compact('contacto'));
  }
  public function update(UpdateContactoRequest $request, $id_contacto) {
    $this->contactoRepo->update($request, $id_contacto);
    toastr()->success('¡Contacto actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_contacto) {
    $this->contactoRepo->destroy($id_contacto);
    toastr()->success('¡Contacto eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}