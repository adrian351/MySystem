<?php
namespace App\Http\Controllers\TecnologiaDeLaInformacion\ArchivosInventario;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\tecnologiaDeLaInformacion\inventarioEquipo\archivoInventario\StoreArchivosInventarioRequest;
// Repositories
use App\Repositories\tecnologiaDeLainformacion\inventarioEquipo\archivoInventario\ArchivoInventarioRepositories;

class ArchivoInventarioController extends Controller {
  protected $archivoRepo;
  public function __construct(ArchivoInventarioRepositories $archivoInventarioRepositories) {
    $this->archivoRepo = $archivoInventarioRepositories;
  }    
  public function store(StoreArchivosInventarioRequest $request, $id_inventario){
    $this->archivoRepo->store($request, $id_inventario);
    toastr()->success('¡Archivo(s) registrado(s) exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_archivo) {
    $this->archivoRepo->destroy($id_archivo);
    toastr()->success('¡Imagen eliminada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}
