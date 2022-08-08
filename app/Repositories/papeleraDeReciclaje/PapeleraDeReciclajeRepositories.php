<?php
namespace App\Repositories\papeleraDeReciclaje;
// Models
use App\Models\PapeleraDeReciclaje;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\tabla\usuarios\UsuariosRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\plantillas\PlantillasRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\quejasYSugerencias\QuejasYSugerenciasRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\proveedores\ProveedoresRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\armados\ArmadosRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\armados\ArmadoTieneImagenesRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\productos\ProductosRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\productos\imagen\ImagenRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\pedidos\PedidosRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\cotizaciones\CotizacionesRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\inventarioEquipos\InventarioEquiposRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\inventarioEquipos\InventarioEquiposImagenesRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\soportes\SoportesRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\manual\ManualRepositories;
use App\Repositories\papeleraDeReciclaje\tabla\etiqueta\EtiquetaRepositories;
//Otro
use Illuminate\Support\Facades\Auth;
use DB;
use App\Events\layouts\ArchivosEliminados;

class PapeleraDeReciclajeRepositories implements PapeleraDeReciclajeInterface {
  protected $serviceCrypt;
  protected $usuariosRepo;
  protected $plantillasRepo;
  protected $quejasYSugerenciasRepo;
  protected $proveedoresRepo;
  protected $armadosRepo;
  protected $armadoTieneImagenesRepo;
  protected $productosRepo;
  protected $imagenRepo;
  protected $pedidosRepo;
  protected $cotizacionesRepo;
  protected $inventarioEquiposRepo;
  protected $inventarioEquiposImagenesRepo;
  protected $soportesRepo;
  protected $manualRepo;
  protected $etiRepo;
  public function __construct(ServiceCrypt $serviceCrypt, 
                              UsuariosRepositories $usuariosRepositories, 
                              PlantillasRepositories $plantillasRepositories, 
                              QuejasYSugerenciasRepositories $quejasYSugerenciasRepositories, 
                              ProveedoresRepositories $proveedoresRepositories, 
                              ArmadosRepositories $armadosRepositories, 
                              ArmadoTieneImagenesRepositories $armadoTieneImagenesRepositories, 
                              ProductosRepositories $productosRepositories,
                              ImagenRepositories $imagenRepositories,
                              PedidosRepositories $pedidosRepositories, 
                              CotizacionesRepositories $cotizacionesRepositories,
                              InventarioEquiposRepositories $inventarioEquiposRepositories,
                              InventarioEquiposImagenesRepositories $inventarioEquiposImagenesRepositories,
                              SoportesRepositories $soportesRepositories,
                              ManualRepositories $manualRepositories,
                              EtiquetaRepositories $etiquetaRepositories
  ) {
    $this->serviceCrypt                   = $serviceCrypt;
    $this->usuariosRepo                   = $usuariosRepositories;
    $this->plantillasRepo                 = $plantillasRepositories;
    $this->quejasYSugerenciasRepo         = $quejasYSugerenciasRepositories;
    $this->proveedoresRepo                = $proveedoresRepositories;
    $this->armadosRepo                    = $armadosRepositories;
    $this->armadoTieneImagenesRepo        = $armadoTieneImagenesRepositories;
    $this->productosRepo                  = $productosRepositories;
    $this->imagenRepo                     = $imagenRepositories;
    $this->pedidosRepo                    = $pedidosRepositories;
    $this->cotizacionesRepo               = $cotizacionesRepositories;
    $this->inventarioEquiposRepo          = $inventarioEquiposRepositories;
    $this->inventarioEquiposImagenesRepo  = $inventarioEquiposImagenesRepositories;
    $this->soportesRepo                   = $soportesRepositories;
    $this->manualRepo                     = $manualRepositories;
    $this->etiRepo                        = $etiquetaRepositories;
  }
  public function papeleraAsignadoFindOrFailById($id_registro) {
    $id_registro = $this->serviceCrypt->decrypt($id_registro);
    $registro = PapeleraDeReciclaje::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->findOrFail($id_registro);
    return $registro;
  }
  public function getPagination($request) {
    return PapeleraDeReciclaje::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($array) {
    $papelera = new PapeleraDeReciclaje();
    $papelera->mod            = $array['modulo'];
    $papelera->reg            = $array['registro'];
    $papelera->tab            = $array['tab'];
    $papelera->id_reg         = $array['id_reg'];
    $papelera->id_fk          = $array['id_fk'];
    $papelera->deleted_at_reg = Auth::user()->email_registro;
    $papelera->save();
    return $papelera;
  }
  public function destroy($id_registro) {
    try { DB::beginTransaction();
      $registro   = $this->papeleraAsignadoFindOrFailById($id_registro);
      $resultado  = $this->tablas($registro, 'destroy');
      $resultado['consulta']->forceDelete();
      $this->destroyAllPapeleraByIdFk($registro->id, $resultado['consulta']->id);
      DB::commit();
      return $registro;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function restore($id_registro) {
    try { DB::beginTransaction();
      $registro = $this->papeleraAsignadoFindOrFailById($id_registro);
      $resultado = $this->tablas($registro, 'restore');
      if($resultado['existe_llave_primaria'] == false) { DB::commit();return false; }
      $resultado['consulta']->restore();
      $this->destroyAllPapeleraByIdFk($registro->id, $resultado['consulta']->id);
      DB::commit();
      return $registro;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroyAllPapeleraByIdFk($id_registro, $id_resultado) {
    $registros =  PapeleraDeReciclaje::where('id_fk', $id_resultado)->get();
    if($registros->isEmpty() == false) { // Verifica si la colección esta vacia
      $hastaC = count($registros) - 1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) { 
        $registros_id[$contador2] = $registros[$contador2]->id;        
      }
      array_push($registros_id, $id_registro);
    } else {
      $registros_id[0] = $id_registro;
    }
    PapeleraDeReciclaje::destroy($registros_id); 
  }
  public function tablas($registro, $metodo) {
    $existe_llave_primaria = 'indefinido';
    if($registro->tab == 'users') {
      $consulta = \App\User::withTrashed()->findOrFail($registro->id_reg);
      $this->usuariosRepo->metodo($metodo, $consulta);

      if($consulta->acceso == '2') { // 2 = Cliente, 1 = Usuario
        //ELIMINA LAS COTIZACIONES CON TODA SU INFORMACIÓN
        $cotizaciones = \App\Models\Cotizacion::with(['armados'])->withTrashed()->where('user_id', $consulta->id)->get();
        foreach($cotizaciones as $cotizacion) {
          $this->cotizacionesRepo->metodo($metodo, $cotizacion);
        }

        // ELIMINA LOS PEDIDOS CON TODA SU INFORMACIÓN
        $pedidos = \App\Models\Pedido::with(['armados', 'pagos'])->withTrashed()->where('user_id', $consulta->id)->get();
        foreach($pedidos as $pedido) {
          $this->pedidosRepo->metodo($metodo, $pedido);
        }
      }

      $qys = \App\Models\QuejaYSugerencia::with(['archivos'=> function ($query) {
        $query->withTrashed();
      }])->withTrashed()->where('user_id', $consulta->id)->get();
      $this->quejasYSugerenciasRepo->metodo($metodo, $qys);
    }
    if($registro->tab == 'roles') {
      $consulta = \Spatie\Permission\Models\Role::withTrashed()->findOrFail($registro->id_reg);
    }
    if($registro->tab == 'plantillas') {
      $consulta = \App\Models\Plantilla::withTrashed()->findOrFail($registro->id_reg);
      $this->plantillasRepo->metodo($metodo, $consulta);
    }
    if($registro->tab == 'catalogos') {
      $consulta = \App\Models\Catalogo::withTrashed()->findOrFail($registro->id_reg);
    }
    if($registro->tab == 'series') {
      $consulta = \App\Models\Serie::withTrashed()->findOrFail($registro->id_reg);
    }
    if($registro->tab == 'proveedores') {
      $consulta = \App\Models\Proveedor::with('productos')->withTrashed()->findOrFail($registro->id_reg);
      $this->proveedoresRepo->metodo($metodo, $consulta);
    }
    if($registro->tab == 'contactos_proveedores') {
      $consulta = \App\Models\ContactoProveedor::with('proveedor')->withTrashed()->findOrFail($registro->id_reg);
      if($consulta->proveedor == null) {
        $existe_llave_primaria = false;
      }
    }
    if($registro->tab == 'armados') {
      $consulta = \App\Models\Armado::with(['imagenes'=> function ($query) {
                                        $query->withTrashed();
                                      }])->withTrashed()->findOrFail($registro->id_reg);
      $this->armadosRepo->metodo($metodo, $consulta);
    }
    if($registro->tab == 'armado_tiene_imagenes') {
      $consulta = \App\Models\ArmadoImagen::with('armado')->withTrashed()->findOrFail($registro->id_reg);
      if($consulta->armado == null) {
        $existe_llave_primaria = false;
      }
      $this->armadoTieneImagenesRepo->metodo($metodo, $consulta);
    }
    if($registro->tab == 'productos') {
      $consulta = \App\Models\Producto::with(['imagenes'=> function ($query) {
                                          $query->withTrashed();
                                        }])->withTrashed()->findOrFail($registro->id_reg);
      $this->productosRepo->metodo($metodo, $consulta);
    }
    if($registro->tab == 'producto_imagenes') {
      $consulta = \App\Models\ProductoImagen::with('producto')->withTrashed()->findOrFail($registro->id_reg);
      if($consulta->producto == null) {
        $existe_llave_primaria = false;
      }
      $this->imagenRepo->metodo($metodo, $consulta);
    }
    if($registro->tab == 'cotizaciones') {
      $consulta = \App\Models\Cotizacion::with(['armados'])->withTrashed()->findOrFail($registro->id_reg);
      $this->cotizacionesRepo->metodo($metodo, $consulta);
    }
    if($registro->tab == 'costos_de_envio') {
      $consulta = \App\Models\CostoDeEnvio::withTrashed()->findOrFail($registro->id_reg);
    }
    if($registro->tab == 'pedidos') {
      $consulta = \App\Models\Pedido::with(['armados', 'pagos'])->withTrashed()->findOrFail($registro->id_reg);
      $this->pedidosRepo->metodo($metodo, $consulta);
    }
    if($registro->tab == 'soportes') {
      $consulta = \App\Models\Soporte::with('archivos')->withTrashed()->findOrFail($registro->id_reg);
      $this->soportesRepo->metodo($metodo, $consulta);
    }
    if($registro->tab == 'inventario_equipos') {
      $consulta = \App\Models\InventarioEquipo::with(['archivos', 'historiales'])->withTrashed()->findOrFail($registro->id_reg);
      $this->inventarioEquiposRepo->metodo($metodo, $consulta);
    }
    if($registro->tab == 'inventario_equipos_archivos') {
      $consulta = \App\Models\InventarioEquipoArchivo::with('inventario')->withTrashed()->findOrFail($registro->id_reg);
      if($consulta->inventario == null) {
        $existe_llave_primaria = false;
      }
      $this->inventarioEquiposImagenesRepo->metodo($metodo, $consulta);      
    }
    if($registro->tab == 'manuales') {
      $consulta = \App\Models\Manual::withTrashed()->findOrFail($registro->id_reg);
      $this->manualRepo->metodo($metodo, $consulta);
    }
    if($registro->tab == 'etiquetas') {
      $consulta = \App\Models\Etiqueta::withTrashed()->findOrFail($registro->id_reg);
      $this->etiRepo->metodo($metodo, $consulta);
    }
    if($consulta == null) {return abort(403, 'Registro no encontrado.');} // ABORTA LA OPERACIÓN EN CASO DE QUE LA CONSULTA SEA NULL
    return [
      'consulta'              => $consulta,
      'existe_llave_primaria' => $existe_llave_primaria
    ];
  }
}