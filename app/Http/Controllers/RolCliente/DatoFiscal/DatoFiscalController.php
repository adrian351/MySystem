<?php
namespace App\Http\Controllers\RolCliente\DatoFiscal;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\rolCliente\datoFiscal\StoreDatoFiscalRequest;
// Repositories
use App\Repositories\rolCliente\datoFiscal\DatoFiscalRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;

class DatoFiscalController extends Controller {
  protected $serviceCrypt;
  protected $datoFiscalRepo;
  public function __construct(ServiceCrypt $serviceCrypt, DatoFiscalRepositories $datoFiscalRepositories) { // Interfaz para implementar solo [metodos] o [metodos y cache] definido en AppServiceProvider
    $this->serviceCrypt   = $serviceCrypt;
    $this->datoFiscalRepo = $datoFiscalRepositories;
  }
  public function index(Request $request) {
    $datos_fiscales = $this->datoFiscalRepo->getPagination($request);
    return view('rolCliente.datoFiscal.dfi_index', compact('datos_fiscales'));
  }
  public function create() {
    return view('rolCliente.datoFiscal.dfi_create');
  }
  public function store(StoreDatoFiscalRequest $request) {
    $this->datoFiscalRepo->store($request);
    toastr()->success('¡Dato fiscal registrado exitosamente, AHORA DEBES SOLICITAR TU FACTURA!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_dato_fiscal) {
    $dato_fiscal = $this->datoFiscalRepo->getDatoFiscalFindOrFail($id_dato_fiscal, []);
    return view('rolCliente.datoFiscal.dfi_show', compact('dato_fiscal'));
  }
  public function edit($id_dato_fiscal) {
    $dato_fiscal = $this->datoFiscalRepo->getDatoFiscalFindOrFail($id_dato_fiscal, []);
    return view('rolCliente.datoFiscal.dfi_edit', compact('dato_fiscal'));
  }
  public function update(StoreDatoFiscalRequest $request, $id_dato_fiscal) {
    $this->datoFiscalRepo->update($request, $id_dato_fiscal);
    toastr()->success('¡Dato fiscal actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_dato_fiscal) {
    $this->datoFiscalRepo->destroy($id_dato_fiscal);
    toastr()->success('¡Dato fiscal eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function getInformacionDatoFiscal(Request $request, $id_dato_fiscal) {
    if($request->ajax()) {
      $dato_fiscal = $this->datoFiscalRepo->getDatoFiscal($this->serviceCrypt->encrypt($id_dato_fiscal));
      return response()->json($dato_fiscal);
    }
  }
}