<?php
namespace App\Http\Controllers\Armado;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\armado\StoreArmadoRequest;
use App\Http\Requests\armado\UpdateArmadoRequest;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\armado\ArmadoRepositories;
use App\Repositories\almacen\producto\ProductoRepositories;
use App\Repositories\sistema\catalogo\CatalogoRepositories;
use App\Repositories\servicio\archivoGenerado\ArchivoGeneradoRepositories;
use App\Repositories\marca\MarcaRepositories;

class ArmadoController extends Controller {
  protected $serviceCrypt;
  protected $armadoRepo;
  protected $productoRepo;
  protected $catalogoRepo;
  protected $marcaRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ArmadoRepositories $armadoRepositories, ProductoRepositories $productoRepositories, CatalogoRepositories $catalogoRepositories, MarcaRepositories $marcaRepositories ) {
    $this->serviceCrypt = $serviceCrypt;
    $this->armadoRepo   = $armadoRepositories;
    $this->productoRepo = $productoRepositories;
    $this->catalogoRepo = $catalogoRepositories;
    $this->marcaRepo = $marcaRepositories;
  }
  public function index(Request $request) {
    $armados = $this->armadoRepo->getPagination($request, '0');
    return view('armado.arm_index', compact('armados'));
  }
  public function create() {
    $gamas_list = $this->catalogoRepo->getAllInputCatalogosPlunk('Armados (Gama)');
    $marcas_list = $this->marcaRepo ->Only_Marcas();
    $tipo_list  = $this->catalogoRepo->getAllInputCatalogosPlunk('Armados (Tipo)');
    return view('armado.arm_create', compact('gamas_list', 'tipo_list', 'marcas_list'));
  }
  public function store(StoreArmadoRequest $request) {
   $armado = $this->armadoRepo->store($request);
    if(auth()->user()->can('armado.edit')) {
      toastr()->success('¡Armado registrado exitosamente ahora puedes registrar sus productos!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return redirect(route('armado.edit', $this->serviceCrypt->encrypt($armado->id))); 
    }
    
    toastr()->success('¡Armado registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function show(Request $request, $id_armado) {
    $armado     = $this->armadoRepo->armadoAsignadoFindOrFailById($id_armado, '0', ['imagenes', 'productos']);
    $imagenes   = $this->armadoRepo->getImagenesArmado($armado);
    $productos  = $this->armadoRepo->getProductosProveedor($armado, $request);
    return view('armado.arm_show', compact('armado', 'productos', 'imagenes'));
  }
  public function edit(Request $request, $id_armado) {
    $armado         = $this->armadoRepo->armadoAsignadoFindOrFailById($id_armado, '0', ['imagenes', 'productos']);
    $imagenes       = $this->armadoRepo->getImagenesArmado($armado);
    $productos      = $this->armadoRepo->getProductosProveedor($armado, $request);
    $productos_list = $this->productoRepo->getAllSustitutosOrProductosMenos($armado->productos, 'original');
    $marcas_list = $this->marcaRepo ->Only_Marcas();
    // $marcas_list[$armado->marca]  = $armado->marca;
    $gamas_list     = $this->catalogoRepo->getAllInputCatalogosPlunk('Armados (Gama)');
    $gamas_list[$armado->gama]  = $armado->gama;
    $tipo_list                  = $this->catalogoRepo->getAllInputCatalogosPlunk('Armados (Tipo)');
    $tipo_list[$armado->tip]    = $armado->tip;

    $armados = $this->armadoRepo->getPagination($request, '0');
    return view('armado.arm_edit', compact('armado', 'productos', 'imagenes', 'productos_list', 'gamas_list', 'tipo_list', 'marcas_list', 'armados'));
  }
  public function update(UpdateArmadoRequest $request, $id_armado) {
    $this->armadoRepo->update($request, $id_armado, '0');
   
    toastr()->success('¡Armado actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_armado) {
    $this->armadoRepo->destroy($id_armado, '0');
    toastr()->success('¡Armado eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function generarCatalogoDeArmados(ArchivoGeneradoRepositories $archivoGeneradoRepo) {
 //   $pdf = \PDF::loadView('armado.export.arm_exp_disCatArm');
 //   return $pdf->stream(); // VER PDF
    return (new \App\Exports\armado\generarCatalogoDeArmadosExport)->download('CatalogoArmados-' . date('Y-m-d') . '-' . time() . '.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    /*
    $usuario = \Illuminate\Support\Facades\Auth::user();
    $archivo_generado = new \App\Models\ArchivosGenerados();
    $archivo_generado->tip              = 'PDF';
    $archivo_generado->arch_rut         = 's';
    $archivo_generado->arch_nom         = 's';
    $archivo_generado->arch_nom_abrev   = 'sss';
    $archivo_generado->user_id          = $usuario->id;
    $archivo_generado->save();
    (new \App\Exports\armado\generarCatalogoDeArmadosExport)->store('CatalogoArmados-' . date('Y-m-d') . '-' . time() . '.pdf', 'public_armado_catalogoArmados', \Maatwebsite\Excel\Excel::DOMPDF);
/*
    (new \App\Exports\armado\generarCatalogoDeArmadosExport)->store('CatalogoArmados-' . date('Y-m-d') . '-' . time() . '.pdf', 'public_armado_catalogoArmados', \Maatwebsite\Excel\Excel::DOMPDF)->chain([
      new \App\Jobs\servicio\NotificarAlUsuarioCuandoTermineLaExportacion($usuario, $archivo_generado)
    ]);
*/
    toastr()->success('¡El reporte se esta generando una vez que haya terminado se mostrara en la barra superior!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }

  public function generarListaDeArmados() {
    return (new \App\Exports\armado\generarListaDeArmadosExport)->download('ReporteDeArmados-'.date('Y-m-d').'.xlsx');
  }
}