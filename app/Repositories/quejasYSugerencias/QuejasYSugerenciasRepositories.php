<?php
namespace App\Repositories\quejasYSugerencias;
// Models
use App\Models\QuejaYSugerencia;
use App\Models\QuejaYSugerenciaArchivo;
// Events
use App\Events\layouts\ArchivoCargado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class QuejasYSugerenciasRepositories implements QuejasYSugerenciasInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  } 
  public function qYSFindOrFailById($id_qys, $relaciones = null) {
    $id_qys = $this->serviceCrypt->decrypt($id_qys);
    $qys    = QuejaYSugerencia::with($relaciones)->findOrFail($id_qys);
    return $qys;
  }
  public function getPagination($request) {
    return QuejaYSugerencia::with('usuario')->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try { DB::beginTransaction();
      $queja_y_sugerencia = new QuejaYSugerencia();
      $queja_y_sugerencia->tip      = $request->tipo;
      $queja_y_sugerencia->depto    = $request->departamento;
      $queja_y_sugerencia->obs      = $request->observaciones;
      $queja_y_sugerencia->user_id  = Auth::user()->id;
      $queja_y_sugerencia->save();

      if($request->archivos != null) {
        $hastaC = count($request->archivos) - 1;
        $camposBD   = array('arch_rut', 'arch_nom', 'queja_y_sugerencia_id');
        $datos      = null;
        $contador3  = 0;
        for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
          // Dispara el evento registrado en App\Providers\EventServiceProvider.php
          $imagen = ArchivoCargado::dispatch(
            $request->archivos[$contador2], // Archivo blob
            'queja-y-sugerencia/' . $queja_y_sugerencia->id, // Ruta en la que guardara el archivo
            'qys-' . $contador2 . time() . '.', // Nombre del archivo
            null // Ruta y nombre del archivo anterior
          ); 
          $datos[$contador2][$camposBD[$contador3]] = $imagen[0]['ruta'];
          $contador3 += 1;
          $datos[$contador2][$camposBD[$contador3]] = $imagen[0]['nombre'];
          $contador3 += 1;
          $datos[$contador2][$camposBD[$contador3]] = $queja_y_sugerencia->id;
          $contador3 = 0;
        }
        QuejaYSugerenciaArchivo::insert($datos);
      }
      DB::commit();
      return $queja_y_sugerencia;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}