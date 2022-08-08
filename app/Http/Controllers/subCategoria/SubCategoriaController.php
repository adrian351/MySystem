<?php

namespace App\Http\Controllers\SubCategoria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\SubCategoria;
// use App\Http\Controllers\Categoria\CategoriaController;
use App\Repositories\categoria\CategoriaRepositories;
use App\Repositories\subCategoria\SubCategoriaRepositories;
class SubCategoriaController extends Controller{
    protected $categoriaRepo;
    protected $subCategoriaRepo;

    public function __construct(SubCategoriaRepositories $subCategoriaRepositories, CategoriaRepositories $categoriaRepositories){
        $this->categoriaRepo = $categoriaRepositories;
        $this->subCategoriaRepo = $subCategoriaRepositories;
    }

    public function index( Request $request){
        // $todos = SubCategoria::paginate()->get();
        $subCategorias = $this->subCategoriaRepo->getPagination($request);

        return view('subCategoria.subCat_index', compact('subCategorias'));
    }

    public function create(){
        $categoria_list = $this->categoriaRepo->Only_Categorias();
        return view('subCategoria.subCat_create', compact('categoria_list'));
    }

    // public function Only_SubCategorias(){
    //     return SubCategoria::all();
    // }
    // public function all_subCategorias(){
    //     $todos = SubCategoria::all();        
    //     return view('subCategoria.index', compact('todos'));
    // }

    public function store(Request $request){

        $this->subCategoriaRepo->store($request);
        toastr()->success('¡SubCategoria registrada exitosamente!');
        return back();

        // try{ DB::beginTransaction();
        //     if($request['subcategoria']== ''){

        //     }else{
        //         $sub_categoria= new SubCategoria();
        //         $sub_categoria-> subcategoria = $request['subcategoria'];
        //         if ($request['descripcion'] != null||$request['descripcion']!=''){
        //             $sub_categoria->descripcion = $request['descripcion'];
        //         }else{
        //             $sub_categoria->descripcion ='Sin descripción';
        //         }
            
        //         $sub_categoria->save(); 
        //         $sub_categoria->categoria()->detach();
        //         if ($request->categoria[0]  !=  null) {
        //             $sub_categoria->categoria()->sync($request->categoria);
        //         }else{
        
        //         }
        //     } 

        //     DB::commit();
        //     return $this->all_subCategorias();
        // }catch(\Exception $e) { DB::rollback(); throw $e;}
    }

   
    public function edit(Request $request, $id_subCategoria){
        $subCategoria = $this->subCategoriaRepo->subCategoriaAsignadoFindOrFailById($id_subCategoria);
        $categoria_list = $this->categoriaRepo->Only_Categorias();


        return view('subCategoria.subCat_edit', compact('subCategoria', 'categoria_list'));
    }
    
    public function update(Request $request, $id_subCategoria){

        $this->subCategoriaRepo->update($request, $id_subCategoria);
        toastr()->success('¡SubCategoria actualizada exitosamente!');
        return back();


        // DB::transaction(function () use ($request, $id){
        //     $sub_categoriaIn = SubCategoria::find($id);
        //     $sub_categoriaIn->subcategoria = $request->subcategoria;
        //     $sub_categoriaIn->descripcion = $request->descripcion;
        //     $sub_categoriaIn->save();

        //     $sub_categoriaIn->categoria()->detach();
        //     if ($request->categoria[0]  !=  null) {
        //         $sub_categoriaIn->categoria()->sync($request->categoria);
        //     }else{
    
        //     }
            
        // });  return $this->all_subCategorias();
    }
    public function destroy($id_subCategoria){
        $this->subCategoriaRepo->destroy($id_subCategoria);
        toastr()->success('¡SubCategoria eliminada exitosamente!');
        return back();

        // try{ DB::beginTransaction();
        //     $sub_categoria = SubCategoria::findorFail($id);
        //     $sub_categoria->categoria()->detach();
        //     $sub_categoria->producto()->detach();
        //     $sub_categoria->delete();

        //     DB::commit();
        //     return $this->all_subCategorias();

        // } catch(\Exception $e) { DB::rollback(); throw $e;}
    }

}