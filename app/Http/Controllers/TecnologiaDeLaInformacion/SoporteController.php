<?php
namespace App\Http\Controllers\TecnologiaDeLaInformacion;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\tecnologiaDeLaInformacion\soporte\UpdateSoporteRequest;
use App\Http\Requests\tecnologiaDeLaInformacion\soporte\StoreSoporteRequest;
// Repositories
use App\Repositories\tecnologiaDeLainformacion\soporte\SoporteRepositories;
use App\Repositories\sistema\catalogo\CatalogoRepositories;
use App\Repositories\tecnologiaDeLainformacion\inventarioEquipo\InventarioEquipoRepositories;

class SoporteController extends Controller{
  protected $soporteRepo;        
  protected $catalogoRepo;
  protected $intarioequipoRepo;
  public function __construct(SoporteRepositories  $soporteRepositories,  CatalogoRepositories $catalogoRepositories, InventarioEquipoRepositories $inventarioEquipoRepositories){
    $this->soporteRepo        = $soporteRepositories;
    $this->catalogoRepo       = $catalogoRepositories;
    $this->intarioequipoRepo  = $inventarioEquipoRepositories;
  }
  public function index(Request $request) { 
    $soportes = $this->soporteRepo->getPagination($request);
    return view('tecnologia_de_la_informacion.soporte.ti_sop_index', compact('soportes'));      
  }
  public function create() {
    return view('tecnologia_de_la_informacion.soporte.ti_sop_create');        
  }
  public function store(StoreSoporteRequest $request) {
    $this->soporteRepo->store($request);   
    toastr()->success('Soporte Registrado exitosamente');
    return back();
  }
  public function show($id_soporte) {
    $soporte = $this->soporteRepo->soporteFindOrFailById($id_soporte, []);
    $archivos = $soporte->archivos()->paginate(99999999);
    return view('tecnologia_de_la_informacion.soporte.ti_sop_show', compact('soporte', 'archivos'));
  }
  public function edit(Request $request, $id_soporte) {
    $soporte = $this->soporteRepo->soporteFindOrFailById($id_soporte, []);
    $archivos = $soporte->archivos()->paginate(99999999);
    $agrupacion_de_fallas_list = $this->catalogoRepo->getAllInputCatalogosPlunk('Soportes (Agrupación de fallas)');
    $inventario_equipo_list = $this->intarioequipoRepo->getAllInventarioEquiposPlunk();
    return view('tecnologia_de_la_informacion.soporte.ti_sop_edit', compact('soporte', 'agrupacion_de_fallas_list', 'inventario_equipo_list', 'archivos'));
  }
  public function update(UpdateSoporteRequest $request, $id_soporte) {
    $respuesta = $this->soporteRepo->update($request, $id_soporte);
    if($respuesta == 'Actualizado') {
      toastr()->success('Soporte Actualizzado exitosamente');
      return back();
    } elseif($respuesta == 'Eliminado') {
      toastr()->success('Soporte registrado exitosamente');
      return redirect(route('soporte.index'));
    } 
  }
  public function destroy($id_soporte) {
    $this->soporteRepo->destroy($id_soporte);
    toastr()->success('¡Soporte eliminado exitosamente!');
    return back();
  }
}