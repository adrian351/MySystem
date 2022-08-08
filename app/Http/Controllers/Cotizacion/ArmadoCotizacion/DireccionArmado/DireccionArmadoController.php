<?php
namespace App\Http\Controllers\Cotizacion\ArmadoCotizacion\DireccionArmado;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\cotizacion\armadoCotizacion\direccionArmado\StoreDireccionArmadoRequest;
use App\Http\Requests\cotizacion\armadoCotizacion\direccionArmado\UpdateDireccionArmadoRequest;
// Repositories
use App\Repositories\cotizacion\armadoCotizacion\direccionArmado\DireccionArmadoRepositories;
use App\Repositories\cotizacion\armadoCotizacion\ArmadoCotizacionRepositories;
use App\Repositories\estado\EstadoRepositories;
use App\Repositories\metodoDeEntrega\MetodoDeEntregaRepositories;

class DireccionArmadoController extends Controller {
  protected $direccionArmadoRepo;
  protected $armadoCotizacionRepo;
  protected $estadoRepo;
  protected $metodoDeEntregaRepo;
  public function __construct(DireccionArmadoRepositories $direccionArmadoRepositories, ArmadoCotizacionRepositories $armadoCotizacionRepositories, EstadoRepositories $estadoRepositories, MetodoDeEntregaRepositories $metodoDeEntregaRepositories) {
    $this->direccionArmadoRepo    = $direccionArmadoRepositories;
    $this->armadoCotizacionRepo   = $armadoCotizacionRepositories;
    $this->estadoRepo             = $estadoRepositories;
    $this->metodoDeEntregaRepo    = $metodoDeEntregaRepositories;
  }
  public function create($id_armado) {
    $armado             = $this->armadoCotizacionRepo->armadoFindOrFailById($id_armado, 'direcciones');
    $this->armadoCotizacionRepo->verificarElEstatusDeLaCotizacion($armado->cotizacion->estat);
    $direcciones        = $armado->direcciones()->paginate(99999999);
    $estados            = $this->estadoRepo->getAllEstadosPluck();
    $metodos_de_entrega = $this->metodoDeEntregaRepo->getAllMetodosPluck();
    return view('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_create', compact('armado', 'direcciones', 'estados', 'metodos_de_entrega'));
  }
  public function store(StoreDireccionArmadoRequest $request, $id_armado) {
    $direccion = $this->direccionArmadoRepo->store($request, $id_armado);
    return $direccion;
  }
  public function edit($id_direccion) {
    $direccion          = $this->direccionArmadoRepo->direccionFindOrFailById($id_direccion);
    $this->armadoCotizacionRepo->verificarElEstatusDeLaCotizacion($direccion->armado->cotizacion->estat);
    $armado             = $direccion->armado;
    $estados            = $this->estadoRepo->getAllEstadosPluck();
    $metodos_de_entrega = $this->metodoDeEntregaRepo->getAllMetodosPluck();
    return view('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_edit', compact('armado', 'direccion', 'estados', 'metodos_de_entrega'));
  }
  public function update(UpdateDireccionArmadoRequest $request, $id_direccion) {
    $direccion = $this->direccionArmadoRepo->update($request, $id_direccion);
    return $direccion;
  }
  public function destroy($id_direccion) {
    $this->direccionArmadoRepo->destroy($id_direccion);
    toastr()->success('¡Dirección eliminada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}