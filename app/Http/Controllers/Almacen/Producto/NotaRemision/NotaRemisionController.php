<?php
namespace App\Http\Controllers\Almacen\Producto\NotaRemision;
// use Barryvdh\DomPDF\PDF;
// Request
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// Repositories
use App\Repositories\servicio\crypt\ServiceCrypt;
use App\Repositories\almacen\producto\ProductoRepositories;
use App\Http\Requests\almacen\producto\notaRemision\StoreNotaRemisionRequest;
use App\Http\Requests\almacen\producto\notaRemision\UpdateNotaRemisionRequest;
use App\Repositories\almacen\producto\nota_remision\NotaRemisionRepositories;
// use PDF;

class NotaRemisionController extends Controller {
  protected $serviceCrypt;
  protected $notaRepo;
  protected $productoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, NotaRemisionRepositories $NotaRemisionRepositories, ProductoRepositories $productoRepositories) {
    $this->serviceCrypt           = $serviceCrypt;
    $this->notaRepo = $NotaRemisionRepositories;
    $this->productoRepo = $productoRepositories;
  }

  public function index(Request $request) {
    $notas = $this->notaRepo->getPagination($request);
    return view('almacen.nota_remision.nota_remision_index', compact('notas'));
  }

  public function store(StoreNotaRemisionRequest $request, $id_producto) {
    $this->notaRepo->store($request, $id_producto); 
    toastr()->success('¡Nota de remision generada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back(); 
  }

  public function edit($id_nota) {
    $nota   = $this->notaRepo->notaRemisionFindOrFailById($id_nota);
    return view('almacen.nota_remision.nota_remision_edit', compact('nota'));
  }
  public function update(UpdateNotaRemisionRequest $request, $id_nota) {
    $this->notaRepo->update($request, $id_nota);
      toastr()->success('Nota actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
      return redirect(route('almacen.nota.index'));
  }

  public function generar($id_nota) {
      $nota   = $this->notaRepo->notaRemisionFindOrFailById($id_nota);
      $nota_pdf = \PDF::loadView('almacen.nota_remision.export.generarNotaRemision', compact('nota'))->setPaper('a4', 'portrait');    
      return $nota_pdf->stream(); // Visualizar
  }

  public function download($id_nota){
    $nota   = $this->notaRepo->notaRemisionFindOrFailById($id_nota);
    $nota = \PDF::loadView('almacen.nota_remision.export.generarNotaRemision', compact('nota'))->setPaper('a4', 'portrait');
    // $this->store($request);
    return $nota->download('nota'.$nota->id.'.pdf');
  }
}