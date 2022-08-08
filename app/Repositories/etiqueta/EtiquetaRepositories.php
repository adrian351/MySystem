<?php
namespace App\Repositories\etiqueta;
use App\Models\Etiqueta;

use App\Events\layouts\ActividadRegistrada;
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
use App\Repositories\servicio\crypt\ServiceCrypt;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use DB;

class EtiquetaRepositories implements EtiquetaInterface {
    protected $serviceCrypt;
    protected $papeleraDeReciclajeRepo;

    public function __construct(ServiceCrypt $serviceCrypt,PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
        $this->serviceCrypt             = $serviceCrypt;
        $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
    } 

    public function etiquetaAsignadoFindOrFailById($id_etiqueta) {
        $id_etiqueta = $this->serviceCrypt->decrypt($id_etiqueta);
        $etiqueta = Etiqueta::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->findOrFail($id_etiqueta);
        return $etiqueta;
    }

    public function getPagination($request) {
        return Etiqueta::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
    }

    // public function etiquetaAsignadoFindOrFailById($id_etiqueta) {
    //     $id_etiqueta = $this->serviceCrypt->decrypt($id_etiqueta);
    //     $etiqueta = Etiqueta::findOrFail($id_etiqueta);
    //     return $etiqueta;
    // }

    public function store($request){
        try{ DB::begintransaction();
            $etiqueta = new Etiqueta();
            $etiqueta->etiqueta   =   $request->etiqueta;
            if ($request['descripcion'] != null || $request['descripcion']!=''){
                $etiqueta->descripcion = $request['descripcion'];
            }else{
                $etiqueta->descripcion ='';
            }

            $etiqueta->asignado_eti       = Auth::user()->email_registro;
            $etiqueta->created_at_eti     = Auth::user()->email_registro;

            $etiqueta->save();
            DB::commit();
            return $etiqueta;
            
        } catch(\Exception $e) { DB::rollback(); throw $e;}
    }

    public function update($request, $id_etiqueta){
        DB::transaction(function () use ($request, $id_etiqueta){
            $etiqueta = $this->etiquetaAsignadoFindOrFailById($id_etiqueta, []);
            $etiqueta->etiqueta = $request->etiqueta;
            $etiqueta->descripcion = $request->descripcion;

            if($etiqueta->isDirty()) {
                // Dispara el evento registrado en App\Providers\EventServiceProvider.php
                ActividadRegistrada::dispatch(
                  'Etiquetas', // Módulo
                  'etiqueta.show', // Nombre de la ruta
                  $id_etiqueta, // Id del registro debe ir encriptado
                  $etiqueta->id, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
                  array('Etiqueta', 'Descripcion'), // Nombre de los inputs del formulario
                  $etiqueta, // Request
                  array('etiqueta', 'descripcion') // Nombre de los campos en la BD
                ); 
                $etiqueta->updated_at_eti  = Auth::user()->email_registro;
              }

            $etiqueta->save();

            return $etiqueta;
        });
    }

    public function destroy($id_etiqueta){
        try{ DB::beginTransaction();
            $etiqueta =  $this->etiquetaAsignadoFindOrFailById($id_etiqueta, []);
            // $etiqueta->subCategoria()->detach();
            $etiqueta->producto()->detach();
            $etiqueta->delete();

            $this->papeleraDeReciclajeRepo->store([
                'modulo'      => 'Etiquetas', // Nombre del módulo del sistema
                'registro'    => $etiqueta->etiqueta, // Información a mostrar en la papelera
                'tab'         => 'etiquetas', // Nombre de la tabla en la BD
                'id_reg'      => $etiqueta->id, // ID de registro eliminado
                'id_fk'       => null // ID de la llave foranea con la que tiene relación           
              ]);

              $etiqueta->producto()->detach();

            DB::commit();
            return $etiqueta;

        } catch(\Exception $e) { DB::rollback(); throw $e;}
    }

    public function all_Etiquetas(){
        $eti = Etiqueta::all();  
        return $eti;
    }

    public function Only_Etiquetas(){
        return Etiqueta::all();  
    }
}