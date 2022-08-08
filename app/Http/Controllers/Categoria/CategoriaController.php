<?php
namespace App\Http\Controllers\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Repositories\servicio\crypt\ServiceCrypt;
use App\Repositories\categoria\CategoriaRepositories;

class CategoriaController extends Controller{
    protected $categoriaRepo;

    public function __construct(CategoriaRepositories $categoriaRepositories) {
        $this->categoriaRepo    = $categoriaRepositories;
    }

    public function index( Request $request){
        $categorias = $this->categoriaRepo->getPagination($request);
        return  view('categoria.cat_index', compact('categorias'));
    }
    public function create(){
        return view('categoria.cat_create');
    }
    public function store(Request $request){
        $this->categoriaRepo->store($request);
        toastr()->success('¡Categoria registrada exitosamente!');
        return back();
    }
   
    public function edit($id_categoria){
        $categoria  = $this->categoriaRepo->categoriaAsignadoFindOrFailById($id_categoria);
        return  view('categoria.cat_edit', compact('categoria'));
    }
    
    public function update(Request $request, $id_categoria){
        $this->categoriaRepo->update($request, $id_categoria);
        toastr()->success('¡Categoria actualizada exitosamente!');
        return back();
    }

    public function destroy($id_categoria){
        $this->categoriaRepo->destroy($id_categoria);
        toastr()->success('¡Categoria eliminada exitosamente!');
        return back();

    }

}
