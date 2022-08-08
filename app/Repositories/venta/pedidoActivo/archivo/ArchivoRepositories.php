<?php
namespace App\Repositories\venta\pedidoActivo\archivo;
// Models
use App\Models\PedidoTieneArchivos;
// Events
use App\Events\layouts\ArchivoCargado;
use App\Events\layouts\ArchivosEliminados;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ArchivoRepositories implements ArchivoInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt               = $serviceCrypt;
    $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
  }
  public function archivoFindOrFailById($id_archivo) {
    $id_archivo = $this->serviceCrypt->decrypt($id_archivo);
    return PedidoTieneArchivos::findOrFail($id_archivo);
  }
  public function store($request, $id_pedido) {
    try { DB::beginTransaction();
      $camposBD   = array('nom_visual', 'arc_rut', 'arc_nom', 'pedido_id', 'created_at_reg', 'created_at');
      $hastaC     = count($request->archivos) - 1;
      $datos      = null;
      $contador3  = 0;
      $id_armado  = $this->serviceCrypt->decrypt($id_pedido);
      $email_usuario = Auth::user()->email_registro;
      $fecha = date('Y-m-d h:i:s');
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->archivos[$contador2], // Archivo blob
          'pedidos/' . date("Y").'/archivos', // Ruta en la que guardara el archivo
          'archivo-' . $contador2 . time() . '.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        );
        $datos[$contador2][$camposBD[$contador3]] = $contador2.'-'.$request->nombre;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $imagen[0]['ruta'];
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $imagen[0]['nombre'];
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $id_armado;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $email_usuario;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $fecha;
        $contador3 = 0;
      }
      PedidoTieneArchivos::insert($datos);

      DB::commit();
      return true;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_archivo) {
    try { DB::beginTransaction();
      $archivo = $this->archivoFindOrFailById($id_archivo);
      $archivo->forceDelete();
      
      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      ArchivosEliminados::dispatch(
        array($archivo->arc_nom), 
      );

      DB::commit();
      return $archivo;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}