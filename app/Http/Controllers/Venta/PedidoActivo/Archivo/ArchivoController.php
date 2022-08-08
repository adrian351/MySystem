<?php
namespace App\Http\Controllers\Venta\PedidoActivo\Archivo;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\venta\pedidoActivo\archivo\StoreArchivoRequest;
// Repositories
use App\Repositories\venta\pedidoActivo\archivo\ArchivoRepositories;

class ArchivoController extends Controller {
  protected $archivoRepo;
  public function __construct(ArchivoRepositories $archivoRepositories) {
    $this->archivoRepo = $archivoRepositories;
  }
  public function store(StoreArchivoRequest $request, $id_pedido) {
    $this->archivoRepo->store($request, $id_pedido);
    toastr()->success('¡Archivo registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
	return back();
  }
  public function destroy($id_pedido) {
    $this->archivoRepo->destroy($id_pedido);
    toastr()->success('¡Archivo eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}