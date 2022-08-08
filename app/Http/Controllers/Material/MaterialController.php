<?php
namespace App\Http\Controllers\Material;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\material\StoreMaterialRequest;
use App\Http\Requests\material\UpdateMaterialRequest;
// Imports
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MaterialesImport;
// Repositories
use App\Repositories\material\MaterialRepositories;

class MaterialController extends Controller {
  protected $materialRepo;
  public function __construct(MaterialRepositories $materialRepositories) { // Interfaz para implementar solo [metodos] o [metodos y cache] definido en AppServiceProvider
    $this->materialRepo    = $materialRepositories;
  }
  public function index(Request $request) {
    $materiales = $this->materialRepo->getPagination($request);
    return view('material.mat_index', compact('materiales'));
  }
  public function create() {
    return view('material.mat_create');
  }
  public function store(StoreMaterialRequest $request) {
    $this->materialRepo->store($request);
    toastr()->success('¡Material registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show($id_material) {
    $material = $this->materialRepo->materialAsignadoFindOrFailById($id_material, []);
    return view('material.mat_show', compact('material'));
  }
  public function edit($id_material) {
    $material = $this->materialRepo->materialAsignadoFindOrFailById($id_material, []);
    return view('material.mat_edit', compact('material'));
  }
  public function update(UpdateMaterialRequest $request, $id_material) {
    $this->materialRepo->update($request, $id_material);
    toastr()->success('¡Material actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_material) {
    $this->materialRepo->destroy($id_material);
    toastr()->success('¡Material eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function consultarPrecio(Request $request) {
    $materiales = $this->materialRepo->getAllMaterialesPlunk();
    $material = $this->materialRepo->getMaterialFind($request->modelo_buscado);
    return view('material.mat_consultarPrecio', compact('materiales', 'material'));
  }
  public function importMaterial(Request $request) {
    \App\Models\Material::truncate();
    (new MaterialesImport)->import($request->archivo);
    
    toastr()->success('¡Materiales cargandose... Esto podria tardar algunos minutos!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}