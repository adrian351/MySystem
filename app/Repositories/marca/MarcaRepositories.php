<?php
namespace App\Repositories\marca;
use App\Models\Marca;
use App\Models\Email;
use App\Models\Dominio;
use App\Models\Telefono;
// use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
use App\Repositories\servicio\crypt\ServiceCrypt;
use DB;

class MarcaRepositories implements MarcaInterface {
    protected $serviceCrypt;
    // protected $papeleraDeReciclajeRepo;

    public function __construct(ServiceCrypt $serviceCrypt
    //  PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories
     ) {
        $this->serviceCrypt             = $serviceCrypt;
        // $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
    } 

    public function getPagination($request) {
        return Marca::buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
    }

    public function marcaAsignadoFindOrFailById($id_marca) {
        $id_marca = $this->serviceCrypt->decrypt($id_marca);
        $marca = Marca::findOrFail($id_marca);
        return $marca;
    }

    public function store($request){
        try{ DB::begintransaction();
            $marca = new Marca();
            $marca->marca = $request->marca;
            $marca->razon_social = $request->razon_social;
            $marca->coment = $request->coment;
            $marca->save();

            $this->addTelefono($request, $marca);

            $dominio = new Dominio();           
                if($request['dominio'] == null){
                  
                }else{
                    $dominio->dominio = $request->dominio;
                    $dominio->save();
                }

            $email = new Email();
                if($request['email'] == null){

                }else{
                    $email->email = $request->email;
                    $email->save();
                }

            $marca->email()->attach($email->id);
            $marca->dominio()->attach($dominio->id);

            DB::commit();
            return $marca;
            
        } catch(\Exception $e) { DB::rollback(); throw $e;}
    }

    public function update($request, $id_marca){
        DB::transaction(function () use ($request, $id_marca){
            $marca = $this->marcaAsignadoFindOrFailById($id_marca, []);
            $marca->marca = $request->marca;
            $marca->razon_social = $request->razon_social;
            $marca->coment = $request->coment;

            $marca->save();

            if($request->dominio_id != 0){
                $dominio = Dominio::find($request->dominio_id);
                if(empty($request->dominio)){
                    $marca->dominio()->detach($dominio->id);
                    $dominio->delete();
                }else{
                    $dominio->dominio = $request->dominio;
                    $dominio->save();             
                }
                            
            }else{  
                if(!empty($request->dominio)){
                    $domNuevo= new Dominio;
                    $domNuevo->dominio= $request->dominio;
                    $domNuevo->save();
                    $marca->dominio()->attach($domNuevo->id);
                }
            }
                    
            if($request->email_id!=0){
                $email = Email::find($request->email_id);
                if(empty($request->email)){ //se elimina la relacion
                    $marca->email()->detach($email->id);
                    $email->delete();      
                }else{
                    // se guarda la marca sin un email
                    $email->email = $request->email;
                    $email->save();
                }
            }else{
                if(!empty($request->email)){
                    // si no hay un email en el registro, agregamos uno nuevo
                    $emailNuevo= new Email;
                    $emailNuevo->email= $request->email;
                    $emailNuevo->save();
                    $marca->email()->attach($emailNuevo->id);
                }
            }
            if($request->telefono_id!=0){
                $telefono = Telefono::find($request->telefono_id);
                if(empty($request->telefono)){
                    $marca->telefono()->detach($telefono->id);
                    $telefono->delete();
        
                }else{
                    $telefono->telefono = $request->telefono;
                    $telefono->tipo = 'local';
                    $telefono->save();
                }        
            }else{
                if(!empty($request->telefono)){
                // si no hay telefono en el registro, agregamos uno nuevo
                    $telefonoNuevo= new Telefono;
                    $telefonoNuevo->telefono= $request->telefono;
                    $telefonoNuevo->tipo='local';
                    $telefonoNuevo->save();
                    $marca->telefono()->attach($telefonoNuevo->id);
                }
            }
            if($request->whats_app_id!=0){
                $whats = Telefono::find($request->whats_app_id);
                if(empty($request->whats_app)){
                    $marca->telefono()->detach($whats->id);
                    $whats->delete();
                }else{
                    $whats->telefono = $request->whats_app;
                    $whats->tipo ='whats_app';
                    $whats->save(); 
                }       
        
            }else{
                if(!empty($request->whats_app)){
                    $whatsNuevo= new Telefono;
                    $whatsNuevo->telefono= $request->whats_app;
                    $whatsNuevo->tipo = 'whats_app';
                    $whatsNuevo->save();
                    $marca->telefono()->attach($whatsNuevo->id);
                }
            }    

            return $marca;
        });
    }

    public function destroy($id_marca){
        try{ DB::beginTransaction();
            $marca =  $this->marcaAsignadoFindOrFailById($id_marca, []);
            $marca->telefono()->delete();
            $marca->dominio()->delete();
            $marca->email()->delete();
        //     // $marca->logotipo()->delete();
            $marca->armados()->detach();
            $marca->delete();


            DB::commit();
            return $marca;

        } catch(\Exception $e) { DB::rollback(); throw $e;}
    }

    private function addTelefono($request,$model){
        if(!empty($request['telefono'])){
        $telefono= new Telefono();
            $telefono->telefono = $request->telefono;       
            $telefono->tipo = 'local';
            $telefono->save();
            $model->telefono()->attach($telefono->id);
        }
        if(!empty($request['whats_app'])){
        $whats= new Telefono();
            $whats->telefono = $request->whats_app;
            $whats->tipo = 'whats_app';
            $whats->save();
            $model->telefono()->attach($whats->id);
        }
    }
    public function Only_Marcas(){
            return Marca::all();
    }
}