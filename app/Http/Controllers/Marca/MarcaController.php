<?php

namespace App\Http\Controllers\Marca;
use App\Http\Controllers\Controller;
use illuminate\Http\Request;

use App\Repositories\marca\MarcaRepositories;
use App\Models\Marca;
class MarcaController extends Controller{
    protected $marcaRepo;

    public function __construct(MarcaRepositories $marcaRepositories) {
        $this->marcaRepo    = $marcaRepositories;
    }

    public function index(Request $request){
        $marcas = $this->marcaRepo->getPagination($request);
        return view('marcas.marca_index', compact('marcas'));
    }

    public function create(){
        return view('marcas.marca_create');
    }

    public function store(Request $request){

        $this->marcaRepo->store($request);
        toastr()->success('¡Marca registrada exitosamente!');
        return back();
    }

    public function edit($id_marca){
        $marca  = $this->marcaRepo->marcaAsignadoFindOrFailById($id_marca);
        return view('marcas.marca_edit', compact('marca'));
    }
    
    public function update(Request $request, $id_marca){
        $this->marcaRepo->update($request, $id_marca);
        toastr()->success('¡Marca actualizada exitosamente!');
        return back(); 
    }

    public function destroy($id_marca){
        $this->marcaRepo->destroy($id_marca);
        toastr()->success('¡Marca eliminada exitosamente!');
        return back();
    }
    // pasamos la lista de las relaciones de marca-armado
    public function byMarcas($armado_id){
        //    $data=Marca::findorfail($armado_id);
        //    return response()->json(['data'=>$data->armados()->get()]);
        $res = Marca::findOrfail($armado_id);
        return response($res->armados()->get());
    }
}
