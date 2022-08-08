<?php
namespace App\Http\Controllers\Sistema;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\sistema\serie\StoreSerieRequest;
use App\Http\Requests\sistema\serie\UpdateSerieRequest;
// Repositories
use App\Repositories\sistema\serie\SerieRepositories;

class SerieController extends Controller {
  protected $serieRepo;
  public function __construct(SerieRepositories $serieRepositories) {
    $this->serieRepo = $serieRepositories;
  }
  public function index(Request $request) {
    $series = $this->serieRepo->getPagination($request);
    return view('sistema.serie.sis_ser_index', compact('series'));
  }
  public function create() {
    return view('sistema.serie.sis_ser_create');
  }
  public function store(StoreSerieRequest $request) {
    $this->serieRepo->store($request);
    toastr()->success('¡Serie registrada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
	return back();
  }
  public function show($id_serie) {
    $serie = $this->serieRepo->serieAsignadoFindOrFailById($id_serie);
    return view('sistema.serie.sis_ser_show', compact('serie'));
  }
  public function edit($id_serie) {
    $serie = $this->serieRepo->serieAsignadoFindOrFailById($id_serie);
    return view('sistema.serie.sis_ser_edit', compact('serie',));
  }
  public function update(UpdateSerieRequest $request, $id_serie) {
    $this->serieRepo->update($request, $id_serie);
    toastr()->success('¡Serie actualizada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_serie) {
    $this->serieRepo->destroy($id_serie);
    toastr()->success('¡Serie eliminada exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}