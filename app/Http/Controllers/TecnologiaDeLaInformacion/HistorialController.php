<?php
namespace App\Http\Controllers\TecnologiaDeLaInformacion;
use App\Http\Controllers\Controller;
//Repositories
use App\Repositories\tecnologiaDeLainformacion\inventarioEquipo\InventarioEquipoRepositories;
use App\Repositories\tecnologiaDeLainformacion\inventarioEquipo\historial_inventario\HistorialInvRepositories;

class HistorialController extends Controller {
  protected $inventarioEquipoRepo;
  protected $historialRepo;
  public function __construct(InventarioEquipoRepositories $inventarioEquipoRepositories, HistorialInvRepositories $historialInvRepositories){
    $this->inventarioEquipoRepo = $inventarioEquipoRepositories;
    $this->historialRepo        = $historialInvRepositories;
  } 
  public function create($id_inventario) {
    $inventario = $this->inventarioEquipoRepo->inventarioFindOrFailById($id_inventario);
    return view('tecnologia_de_la_informacion.inventarioEquipo.historiales.ti_inv_hisInv_create', compact('inventario'));
  }
  public function show($id_historial) {
    $historial = $this->historialRepo->historialFindOrFailById($id_historial);
    $archivos = $historial->historialArchivos()->paginate(99999999);
    return view('tecnologia_de_la_informacion.inventarioEquipo.historiales.ti_inv_hisInv_show', compact('historial', 'archivos'));
  }
}