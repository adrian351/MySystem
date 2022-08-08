<?php
namespace App\Repositories\categoria;
use App\Models\Categoria;
// use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
use App\Repositories\servicio\crypt\ServiceCrypt;
use DB;

class CategoriaRepositories implements CategoriaInterface {
    protected $serviceCrypt;
    // protected $papeleraDeReciclajeRepo;

    public function __construct(ServiceCrypt $serviceCrypt
    //  PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories
     ) {
        $this->serviceCrypt             = $serviceCrypt;
        // $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
    } 

    public function getPagination($request) {
        return Categoria::buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
    }

    public function categoriaAsignadoFindOrFailById($id_categoria) {
        $id_categoria = $this->serviceCrypt->decrypt($id_categoria);
        $categoria = Categoria::findOrFail($id_categoria);
        return $categoria;
    }

    public function store($request){
        try{ DB::begintransaction();
            $categoria = new Categoria();
            $categoria->categoria   =   $request->categoria;
            // $categoria->descripcion =   $request->descripcion;
            if ($request['descripcion'] != null || $request['descripcion']!=''){
                $categoria->descripcion = $request['descripcion'];
            }else{
                $categoria->descripcion ='Sin descripción';
            }

            $categoria->save();
            DB::commit();
            return $categoria;
            
        } catch(\Exception $e) { DB::rollback(); throw $e;}
    }

    public function update($request, $id_categoria){
        DB::transaction(function () use ($request, $id_categoria){
            $categoria = $this->categoriaAsignadoFindOrFailById($id_categoria, []);
            $categoria->categoria = $request->categoria;
            $categoria->descripcion = $request->descripcion;
            $categoria->save();

            return $categoria;
        });
    }

    public function destroy($id_categoria){
        try{ DB::beginTransaction();
            $categoria =  $this->categoriaAsignadoFindOrFailById($id_categoria, []);
            $categoria->subCategoria()->detach();
            $categoria->producto()->detach();
            $categoria->delete();

            DB::commit();
            return $categoria;

        } catch(\Exception $e) { DB::rollback(); throw $e;}
    }

    public function all_Categorias(){
        $cat = Categoria::all();  
        return $cat;
    }

    public function Only_Categorias(){
        return Categoria::all();  
    }
}