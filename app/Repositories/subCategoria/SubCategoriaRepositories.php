<?php
namespace App\Repositories\subCategoria;
use App\Models\SubCategoria;
// use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
use App\Repositories\servicio\crypt\ServiceCrypt;
use DB;

class SubCategoriaRepositories implements SubCategoriaInterface {
    protected $serviceCrypt;
    // protected $papeleraDeReciclajeRepo;

    public function __construct(ServiceCrypt $serviceCrypt 
        // PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories
    ) {
        $this->serviceCrypt             = $serviceCrypt;
        // $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
    } 

    public function getPagination($request) {
        return SubCategoria::buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
    }

    public function subCategoriaAsignadoFindOrFailById($id_subCategoria) {
        $id_subCategoria = $this->serviceCrypt->decrypt($id_subCategoria);
        $sub_categoria = SubCategoria::findOrFail($id_subCategoria);
        return $sub_categoria;
    }

    public function store($request){
        try{ DB::begintransaction();
            $sub_categoria = new SubCategoria();
            $sub_categoria->subcategoria = $request->subCategoria;
            if ($request['descripcion'] != null || $request['descripcion']!=''){
                $sub_categoria->descripcion = $request['descripcion'];
            }else{
                $sub_categoria->descripcion ='';
            }
            $sub_categoria->save(); 
            $sub_categoria->categoria()->detach();

            if ($request->categoria[0]  !=  null) {
                $sub_categoria->categoria()->sync($request->categoria);
            }

            DB::commit();
            return $sub_categoria;
            
        } catch(\Exception $e) { DB::rollback(); throw $e;}
    }

    public function update($request, $id_subCategoria){
        DB::transaction(function () use ($request, $id_subCategoria){
            $sub_categoria = $this->subCategoriaAsignadoFindOrFailById($id_subCategoria, []);
            $sub_categoria->subcategoria = $request->subCategoria;
            $sub_categoria->descripcion = $request->descripcion;

            $sub_categoria->save();
            $sub_categoria->categoria()->detach();

            if ($request->categoria[0]  !=  null) {
                $sub_categoria->categoria()->sync($request->categoria);
            }

            return $sub_categoria;
        });
    }

    public function destroy($id_subCategoria){
        try{ DB::beginTransaction();
            $sub_categoria = $this->subCategoriaAsignadoFindOrFailById($id_subCategoria, []);
            $sub_categoria->categoria()->detach();
            $sub_categoria->producto()->detach();
            $sub_categoria->delete();

            DB::commit();
            return $sub_categoria;
            
        } catch(\Exception $e) { DB::rollback(); throw $e;}
    }

    public function Only_SubCategorias(){
        return SubCategoria::all();
    }

}