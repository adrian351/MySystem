<?php
namespace App\Http\Controllers\Etiqueta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\servicio\crypt\ServiceCrypt;
use App\Repositories\etiqueta\EtiquetaRepositories;

class EtiquetaController extends Controller{
    protected $etiquetaRepo;
    protected $serviceCrypt;

    public function __construct(ServiceCrypt $serviceCrypt, EtiquetaRepositories $etiquetaRepositories) {
        $this->etiquetaRepo    = $etiquetaRepositories;
        $this->serviceCrypt = $serviceCrypt;
    }

    public function index( Request $request){
        $etiquetas = $this->etiquetaRepo->getPagination($request);
        return  view('etiqueta.eti_index', compact('etiquetas'));
    }
    public function create(){
        return view('etiqueta.eti_create');
    }
    public function store(Request $request){
        $this->etiquetaRepo->store($request);
        toastr()->success('¡Etiqueta registrada exitosamente!');
        return back();
    }

    public function show($id_etiqueta){
        $etiqueta = $this->etiquetaRepo->etiquetaAsignadoFindOrFailById($id_etiqueta, []);
        return view('etiqueta.eti_show', compact('etiqueta'));
    }
   
    public function edit($id_etiqueta){
        $etiqueta  = $this->etiquetaRepo->etiquetaAsignadoFindOrFailById($id_etiqueta);
        return  view('etiqueta.eti_edit', compact('etiqueta'));
    }
    
    public function update(Request $request, $id_etiqueta){
        $this->etiquetaRepo->update($request, $id_etiqueta);
        toastr()->success('¡Etiqueta actualizada exitosamente!');
        return back();
    }

    public function destroy($id_etiqueta){
        $this->etiquetaRepo->destroy($id_etiqueta);
        toastr()->success('¡Etiqueta eliminada exitosamente!');
        return back();

    }

}
