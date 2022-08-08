<?php
namespace App\Http\Controllers\Armado\ClonArmado;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\armado\clonArmado\UpdateClonArmadoRequest;
// Repositories
use App\Repositories\armado\clonArmado\ClonArmadoRepositories;
use App\Repositories\armado\ArmadoRepositories;
use App\Repositories\almacen\producto\ProductoRepositories;
use App\Repositories\sistema\catalogo\CatalogoRepositories;
use App\Http\Controllers\Marca\MarcaController;


class ClonArmadoController extends Controller {
  protected $clonArmadoRepo;
  protected $armadoRepo;
  protected $productoRepo;
  protected $catalogoRepo;
  public function __construct(ClonArmadoRepositories $clonArmadoRepositories, ArmadoRepositories $armadoRepositories, ProductoRepositories $productoRepositories, CatalogoRepositories $catalogoRepositories,  MarcaController $marcaController) {
    $this->clonArmadoRepo = $clonArmadoRepositories;
    $this->armadoRepo     = $armadoRepositories;
    $this->productoRepo   = $productoRepositories;
    $this->catalogoRepo   = $catalogoRepositories;
    $this->marcaRepo = $marcaController;
  }
  public function index(Request $request) {
    $armados = $this->armadoRepo->getPagination($request, '1');
    return view('armado.clon_armado.arm_cloArm_index', compact('armados'));
  }
  public function store($id_armado) {
    $respuesta = $this->clonArmadoRepo->store($id_armado);
    // $marcas_list = $this->marcaRepo ->Only_Marcas();
    if($respuesta == false) {
      toastr()->error('¡Este armado no se puede clonar!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return back();
    }
    toastr()->success('¡Armado clonado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show(Request $request, $id_armado) {
    $armado      = $this->armadoRepo->armadoAsignadoFindOrFailById($id_armado, '1', ['imagenes', 'productos']);
    $imagenes = $this->armadoRepo->getImagenesArmado($armado);
    $productos  = $this->armadoRepo->getProductosProveedor($armado, 
    $request);
    $marcas_list = $this->marcaRepo ->Only_Marcas();
    return view('armado.clon_armado.arm_cloArm_show', compact('armado', 'productos', 'imagenes', 'marcas_list'));
  }
  public function edit(Request $request, $id_armado) {
    $armado          = $this->armadoRepo->armadoAsignadoFindOrFailById($id_armado, '1', ['imagenes', 'productos']);
    $imagenes = $this->armadoRepo->getImagenesArmado($armado);
    $productos      = $this->armadoRepo->getProductosProveedor($armado, $request);
  //  $productos_list = $this->productoRepo->getAllSustitutosOrProductosPlunkMenos($armado->productos, 'original');
    $productos_list = $this->productoRepo->getAllSustitutosOrProductosMenos($armado->productos, 'original');
    $gamas_list = $this->catalogoRepo->getAllInputCatalogosPlunk('Armados (Gama)');
    $gamas_list[$armado->gama] = $armado->gama;
    $tipo_list = $this->catalogoRepo->getAllInputCatalogosPlunk('Armados (Tipo)');
    $tipo_list[$armado->tip] = $armado->tip;
    $marcas_list = $this->marcaRepo ->Only_Marcas();
    return view('armado.clon_armado.arm_cloArm_edit', compact('armado', 'productos', 'imagenes', 'productos_list', 'gamas_list', 'tipo_list', 'marcas_list'));
  }
  public function update(UpdateClonArmadoRequest $request, $id_armado) {
    $this->armadoRepo->update($request, $id_armado, '1');
    toastr()->success('¡Armado actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_armado) {
    $this->armadoRepo->destroy($id_armado, '1');
    toastr()->success('¡Armado eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}