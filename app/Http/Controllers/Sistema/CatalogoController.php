<?php
namespace App\Http\Controllers\Sistema;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\sistema\catalogo\StoreCatalogoRequest;
use App\Http\Requests\sistema\catalogo\UpdateCatalogoRequest;
// Repositories
use App\Repositories\sistema\catalogo\CatalogoRepositories;

class CatalogoController extends Controller {
  protected $catalogoRepo;
  public function __construct(CatalogoRepositories $catalogoRepositories) { // Interfaz para implementar solo [metodos]
    $this->catalogoRepo = $catalogoRepositories;
  }
  public function index(Request $request) {
    $catalogos = $this->catalogoRepo->getPagination($request);
    return view('sistema.catalogo.sis_cat_index', compact('catalogos'));
  }
  public function create() {
    return view('sistema.catalogo.sis_cat_create');
  }
  public function store(StoreCatalogoRequest $request) {
    $this->catalogoRepo->store($request);
    toastr()->success('¡Catálogo registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
	return back();
  }
  public function show($id_catalogo) {
    $catalogo = $this->catalogoRepo->catalogoAsignadoFindOrFailById($id_catalogo);
    return view('sistema.catalogo.sis_cat_show', compact('catalogo'));
  }
  public function edit($id_catalogo) {
    $catalogo = $this->catalogoRepo->catalogoAsignadoFindOrFailById($id_catalogo);
    return view('sistema.catalogo.sis_cat_edit', compact('catalogo',));
  }
  public function update(UpdateCatalogoRequest $request, $id_catalogo) {
    $this->catalogoRepo->update($request, $id_catalogo);
    toastr()->success('¡Catálogo actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_catalogo) {
    $this->catalogoRepo->destroy($id_catalogo);
    toastr()->success('¡Catálogo eliminada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}