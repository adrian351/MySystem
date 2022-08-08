<?php
namespace App\Repositories\logistica\direccionEntregada;
// Models
use App\Models\PedidoArmadoTieneDireccion;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\logistica\direccionLocal\EstatusArmadoRepositories;
// Otros

use App\Models\PedidoArmadoDireccionTieneComprobante;

use Illuminate\Support\Facades\Auth;
use DB;

class DireccionEntregadaRepositories implements DireccionEntregadaInterface {
  protected $serviceCrypt;
  protected $estatusArmadoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, EstatusArmadoRepositories $estatusArmadoRepositories) {
    $this->serviceCrypt       = $serviceCrypt;
    $this->estatusArmadoRepo  = $estatusArmadoRepositories;
  }
  public function direccionEntregadaFindOrFailById($id_direccion, $relaciones) {
    $id_direccion = $this->serviceCrypt->decrypt($id_direccion);
    $direccion = PedidoArmadoTieneDireccion::with($relaciones)
    ->whereBetween('updated_at', [date("Y-m-d", strtotime('-90 day', strtotime(date("Y-m-d")))), date("Y-m-d", strtotime('+1 day', strtotime(date("Y-m-d"))))])
    ->where('estat', config('app.entregado'))
    ->findOrFail($id_direccion);
    return $direccion;
  }
  public function getPagination($request, $relaciones) {
    if($request->paginador == null) {
      $paginador = 50;
    }else {
      $paginador = $request->paginador;
    }
    
    return PedidoArmadoTieneDireccion::with($relaciones)
    ->whereBetween('updated_at', [date("Y-m-d", strtotime('-90 day', strtotime(date("Y-m-d")))), date("Y-m-d", strtotime('+1 day', strtotime(date("Y-m-d"))))])
    ->with(['armado'=> function ($query) {
      $query->select('id', 'cod', 'pedido_id')->with(['pedido'=> function ($query) {
        $query->select('id', 'fech_de_entreg');
      }]);
    }])
    ->where('estat', config('app.entregado'))
    ->buscar($request->opcion_buscador, $request->buscador)
    ->orderBy('updated_at', 'DESC')
    ->paginate($paginador);
  }
  public function regresarEnRuta($id_direccion) {
    try { DB::beginTransaction();
      $direccion = $this->direccionEntregadaFindOrFailById($id_direccion, ['armado']);
      $direccion->estat = config('app.en_ruta');

      if($direccion->isDirty()) { 
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Lista de direcciones entregadas', // Módulo
          'logistica.direccionEntregada.show', // Nombre de la ruta
          $id_direccion, // Id del registro debe ir encriptado
          $direccion->armado->cod, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Estatus'), // Nombre de los inputs del formulario
          $direccion, // Request
          array('estat') // Nombre de los campos en la BD
        ); 
        $direccion->updated_at_direc_arm  = Auth::user()->email_registro;
      }

      $direccion->save();

      $this->estatusArmadoRepo->estatusArmado($direccion);
            //parchesito

          if(count($direccion->comprobantes)>0){
                //eliminar
            \Storage::disk('s3')->delete($direccion->comp_ent_nom);  
            $comprobante =   PedidoArmadoDireccionTieneComprobante::findOrFail($direccion->comprobantes[0]->id);
          
            $comprobante->comp_ent_nom = 'imagenes_estaticas/SIN-IMAGEN.jpg';
            $comprobante->save();
          }

      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}