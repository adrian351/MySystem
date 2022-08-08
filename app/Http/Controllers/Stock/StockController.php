<?php
namespace App\Http\Controllers\Stock;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\stock\StoreStockeRequest;
use App\Http\Requests\stock\UpdateStockRequest;
// Repositories
use App\Repositories\stock\StockRepositories;
use App\Repositories\armado\ArmadoRepositories;

class StockController extends Controller {
  protected $stockRepo;
  protected $armadoRepo;
  public function __construct(StockRepositories $stockRepositories, ArmadoRepositories $armadoRepositories) {
    $this->stockRepo  = $stockRepositories;
    $this->armadoRepo = $armadoRepositories;
  }
  public function index(Request $request) {
    $stocks = $this->stockRepo->getPagination($request);
    return view('stock.sto_index', compact('stocks'));
  }
  public function create() {
    $stocks = $this->stockRepo->stocksRegistrados();
 
    if(isset($stocks[0]) ) {
      $ids = [];
      foreach($stocks as $stock) {
        foreach($stock->armados as $armado) {
          array_push($ids, $armado->id);
        }
      }
      $armados_list = $this->armadoRepo->getAllArmadosPlunkMenosId($ids);
    } else {
      $armados_list = $this->armadoRepo->getAllArmadosPlunk();
    }

    return view('stock.sto_create', compact('armados_list'));
  }
  public function store(StoreStockeRequest $request) {
    $this->stockRepo->store($request);
    toastr()->success('¡Stock registrado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
	return back();
  }
  public function show($id_stock) {
    $stock = $this->stockRepo->stockFindOrFailById($id_stock, ['armados']);
    return view('stock.sto_show', compact('stock'));
  }
  public function edit($id_stock) {
    $stock = $this->stockRepo->stockFindOrFailById($id_stock, ['armados']);
    return view('stock.sto_edit', compact('stock'));
  }
  public function update(UpdateStockRequest $request, $id_stock) {
    $this->stockRepo->update($request, $id_stock);
    toastr()->success('¡Stock actualizado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
  public function destroy($id_stock) {
    $this->stockRepo->destroy($id_stock);
    toastr()->success('¡Stock eliminado exitosamente!'); // Ruta archivo de configuración "vendor\yoeunes\toastr\config"
    return back();
  }
}