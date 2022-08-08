<?php
namespace App\Repositories\almacen\producto\nota_remision;
// Models
use App\Models\NotaRemisionProducto;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;

// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
use App\Repositories\almacen\producto\ProductoRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class NotaRemisionRepositories implements NotaRemisionInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  protected $productoRepo; 
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories, ProductoRepositories $productoRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->papeleraDeReciclajeRepo  = $papeleraDeReciclajeRepositories; //pendiente implementar función " delete"
    $this->productoRepo             = $productoRepositories;
  }

  public function notaRemisionFindOrFailById($id_nota) {
    $id_nota = $this->serviceCrypt->decrypt($id_nota);
    $nota = NotaRemisionProducto::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->findOrFail($id_nota);
    return $nota;
  }

  public function getPagination($request) {
    return NotaRemisionProducto::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('estat', 'DESC')->paginate($request->paginador);
  }

  public function store($request, $id_producto) {
    try { DB::beginTransaction();
      $nota = new NotaRemisionProducto();
      $nota->product        = $request->producto;
      $nota->cant_envio     = $request->cantidad;
      $nota->alm_sal        = $request->alm_sal;
      $nota->alm_ent        = $request->alm_ent;
      $nota->per_aprueba    = $request->per_aprueba;
      $nota->per_lleva      = $request->per_lleva;
      $nota->coment         = $request->coment;
      $nota->producto_id    = $request->producto_id;
      $nota->asignado_not   = Auth::user()->email_registro;
      $nota->created_at_not = Auth::user()->email_registro;

      $this->accionStockProducto($nota, $id_producto);

      $nota->save();
      DB::commit();
      return $nota;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }

  public function update($request, $id_nota){
    DB::transaction(function() use($request, $id_nota) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $nota                 = $this->notaRemisionFindOrFailById($id_nota );
      $nota->per_recibe         = $request->per_recibe;
      $nota->cant_recibida     = $request->cant_recibida;
     
      if($nota->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Notas', // Módulo
          'almacen.nota.show', // Nombre de la ruta
          $id_nota, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_nota), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('per_recibe', 'cant_recibida', ), // Nombre de los inputs del formulario
          $nota, // Request
          array('per_recibe', 'cant_recibida') // Nombre de los campos en la BD
        );
        $nota->updated_at_not = Auth::user()->email_registro;
      }
      $nota->save();
      NotaRemisionProducto::getEstatusNota($nota);
      return $nota;
    });
  }
  
  public function accionStockProducto($nota, $id_producto){
    $producto = $this->productoRepo->productoAsignadoFindOrFailById($id_producto, []);
    if($nota->alm_sal == 'Temas'){
      $producto->stock_temas -= $nota->cant_envio;
      $producto->stock += $nota->cant_envio;
     
      // $restarCantidad = $nota->cant;
      // $restarCantidadInt = (int)$restarCantidad;
      // $idProducto = $nota->producto_id;
      // DB::table('productos')->select('stock_temas')->where('id', $idProducto)->decrement('stock_temas', $restarCantidadInt);
      // DB::table('productos')->select('stock')->where('id', $idProducto)->increment('stock', $restarCantidadInt);
     
    }else if($nota->alm_sal == 'Naucalpan'){
      $producto->stock -= $nota->cant_envio;
      $producto->stock_temas += $nota->cant_envio;

      // $restarCantidad = $nota->cant;
      // $restarCantidadInt = (int)$restarCantidad;
      // $idProducto = $nota->producto_id;
      // DB::table('productos')->select('stock')->where('id', $idProducto)->decrement('stock', $restarCantidadInt);
      // DB::table('productos')->select('stock_temas')->where('id', $idProducto)->increment('stock_temas', $restarCantidadInt);
    }
    $producto->save();
  }
}