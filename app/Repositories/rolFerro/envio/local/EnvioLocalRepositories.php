<?php
namespace App\Repositories\rolFerro\envio\local;
// Models
use App\Models\PedidoArmadoTieneDireccion;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class EnvioLocalRepositories implements EnvioLocalInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt               = $serviceCrypt;
    $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
  }
  public function envioFindOrFailById($id_envio, $for_loc, $relaciones) {
    $id_envio = $this->serviceCrypt->decrypt($id_envio);
    $envio = PedidoArmadoTieneDireccion::with($relaciones)->where('met_de_entreg', 'Transportes Ferro')->where('for_loc', $for_loc);
    $envio->where(function ($query) {
      $query->where('estat', config('app.en_almacen_de_salida'))
      ->orWhere('estat', config('app.sin_entrega_por_falta_de_informacion'))
      ->orWhere('estat', config('app.intento_de_entrega_fallido'));
    });
    return $envio->findOrFail($id_envio);
  }
  public function getPagination($request, $for_loc, $relaciones) {
		return PedidoArmadoTieneDireccion::with($relaciones)
    ->with(['armado'=> function ($query) {
      $query->select('id', 'cod', 'pedido_id')->with(['pedido'=> function ($query) {
        $query->select('id', 'fech_de_entreg');
      }]);
    }])
    ->where('for_loc', $for_loc)
  //  ->where('estat', '!=', config('app.entregado')
    
    ->where(function ($query) {
      $query->where('estat', config('app.pendiente'))
      ->orWhere('estat', config('app.en_almacen_de_salida'))
        ->orWhere('estat', config('app.en_ruta'))
        ->orWhere('estat', config('app.sin_entrega_por_falta_de_informacion'))
        ->orWhere('estat', config('app.intento_de_entrega_fallido'));
			})
				
    ->buscar($request->opcion_buscador, $request->buscador)
    ->orderBy('fech_en_alm_salida', 'DESC')
		->paginate($request->paginador);
  }
  public function update($request, $id_envio, $for_loc, $modulo, $ruta) {
    try { DB::beginTransaction();
      $envio       = $this->envioFindOrFailById($id_envio,  $for_loc, []);
      $envio->rut  = $request->ruta;
    
      if($envio->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          $modulo, // Módulo
          $ruta, // Nombre de la ruta
          $id_envio, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_envio), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Ruta'), // Nombre de los inputs del formulario
          $envio, // Request
          array('rut') // Nombre de los campos en la BD
        ); 
        $envio->updated_at_direc_arm  = Auth::user()->email_registro;
      }
    
      $envio->save();

      DB::commit();
      return $envio;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}