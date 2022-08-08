<?php
namespace App\Repositories\proveedor;
// Models
use App\Models\Proveedor;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
use App\Repositories\servicio\calculo\CalculoRepositories;
use App\Repositories\armado\CalcularValoresArmadoRepositories;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
// Otros
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use DB;

class ProveedorRepositories implements ProveedorInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  protected $calculoRepo;
  protected $calcularValoresArmadoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories, CalculoRepositories $calculoRepositories, CalcularValoresArmadoRepositories $calcularValoresArmadoRepositories) {
    $this->serviceCrypt               = $serviceCrypt;
    $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
    $this->calculoRepo                = $calculoRepositories;
    $this->calcularValoresArmadoRepo  = $calcularValoresArmadoRepositories;
  }
  public function proveedorAsignadoFindOrFailById($id_proveedor, $relaciones = null) { //'contactos', 'productos'
    $id_proveedor = $this->serviceCrypt->decrypt($id_proveedor);
    $proveedor = Proveedor::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->with($relaciones)->findOrFail($id_proveedor);
    return $proveedor;
  }
  public function getPagination($request) {
    return Proveedor::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    DB::transaction(function() use($request) { // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $proveedor                  = new Proveedor();
      $proveedor->raz_soc         = $request->razon_social;
      $proveedor->nom_comerc      = $request->nombre_comercial;
      $proveedor->fab_distri      = $request->fabricante_distribuidor;
      $proveedor->rfc             = $request->rfc;
      $proveedor->nom_rep_legal   = $request->nombre_del_representante_legal;
      $proveedor->pag_web         = $request->pagina_web;
      $proveedor->lad_fij         = $request->lada_telefono_fijo;
      $proveedor->tel_fij         = $request->telefono_fijo;
      $proveedor->ext             = $request->extension;
      $proveedor->lad_mov         = $request->lada_telefono_movil;
      $proveedor->tel_mov         = $request->telefono_movil;
      $proveedor->ops             = $request->opcion;
      $proveedor->cant_min_comp   = $request->cantidad_o_monto_minimo_de_compra;
      $proveedor->marc            = $request->marca;
      $proveedor->obs             = $request->observaciones;
      $proveedor->call            = $request->calle;
      $proveedor->no_ext          = $request->no_ext;
      $proveedor->no_int          = $request->no_int;
      $proveedor->pais            = $request->pais;
      $proveedor->ciudad          = $request->ciudad;
      $proveedor->col             = $request->colonia;
      $proveedor->del_o_munic     = $request->delegacion_o_municipio;
      $proveedor->cod_post        = $request->codigo_postal;
      $proveedor->ref             = $request->referencias;
      $proveedor->asignado_prov   = Auth::user()->email_registro;
      $proveedor->created_at_prov = Auth::user()->email_registro;
      if($request->hasfile('archivo')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $archivo = ArchivoCargado::dispatch(
          $request->file('archivo'), // Archivo blob
          'proveedores/'.date("Y"), // Ruta en la que guardara el archivo
          'proveedor-'.time().'.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        ); 
        $proveedor->arch_rut  = $archivo[0]['ruta'];
        $proveedor->arch_nom  = $archivo[0]['nombre'];
      }
      $proveedor->save();
      $this->eliminarCacheAllProveedoresPlunk();
      return $proveedor;
    });
  }
  public function update($request, $id_proveedor) {
    DB::transaction(function() use($request, $id_proveedor) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $proveedor = $this->proveedorAsignadoFindOrFailById($id_proveedor, 'productos');
      $proveedor->raz_soc         = $request->razon_social;
      $proveedor->nom_comerc      = $request->nombre_comercial;
      $proveedor->fab_distri      = $request->fabricante_distribuidor;
      $proveedor->rfc             = $request->rfc;
      $proveedor->nom_rep_legal   = $request->nombre_del_representante_legal;
      $proveedor->pag_web         = $request->pagina_web;
      $proveedor->lad_fij         = $request->lada_telefono_fijo;
      $proveedor->tel_fij         = $request->telefono_fijo;
      $proveedor->ext             = $request->extension;
      $proveedor->lad_mov         = $request->lada_telefono_movil;
      $proveedor->tel_mov         = $request->telefono_movil;
      $proveedor->ops             = $request->opcion;
      $proveedor->cant_min_comp   = $request->cantidad_o_monto_minimo_de_compra;
      $proveedor->obs             = $request->observaciones;
      $proveedor->call            = $request->calle;
      $proveedor->no_ext          = $request->no_ext;
      $proveedor->no_int          = $request->no_int;
      $proveedor->pais            = $request->pais;
      $proveedor->ciudad          = $request->ciudad;
      $proveedor->col             = $request->colonia;
      $proveedor->del_o_munic     = $request->delegacion_o_municipio;
      $proveedor->cod_post        = $request->codigo_postal;
      $proveedor->ref             = $request->referencias;
      if($proveedor->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Proveedores', // Módulo
          'proveedor.show', // Nombre de la ruta
          $id_proveedor, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_proveedor), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Razón social', 'Nombre comercial', 'Fabricante / Distribuidor', 'RFC', 'Nombre del representante legal', 'Página web', 'Lada teléfono fijo', 'Teléfono fijo', 'Extensión', 'Lada teléfono móvil', 'Teléfono móvil', 'Opción', 'Cantidad o monto mínimo de compra', 'Marca', 'Observaciones', 'Calle', 'No. Ext.', 'No. Int.', 'Pais', 'Ciudad', 'Colonia', 'Delegación o municipio', 'Código postal', 'Referencias'), // Nombre de los inputs del formulario
          $proveedor, // Request
          array('raz_soc', 'nom_comerc', 'fab_distri', 'rfc', 'nom_rep_legal', 'pag_web', 'lad_fij', 'tel_fij', 'ext', 'lad_mov', 'tel_mov', 'ops', 'cant_min_comp', 'obs', 'call', 'no_ext', 'no_int', 'pais', 'ciudad', 'col', 'del_o_munic', 'cod_post', 'ref') // Nombre de los campos en la BD
        ); 
        $proveedor->updated_at_prov = Auth::user()->email_registro;
      }
      if($request->hasfile('archivo')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $archivo = ArchivoCargado::dispatch(
          $request->file('archivo'), // Archivo blob
          'proveedores/'.date("Y"), // Ruta en la que guardara el archivo
          'proveedor-'.time().'.', // Nombre del archivo
          $proveedor->arch_nom // Ruta y nombre del archivo anterior
        ); 
        $proveedor->arch_rut  = $archivo[0]['ruta'];
        $proveedor->arch_nom  = $archivo[0]['nombre'];
      }
      if($proveedor->getOriginal('nom_comerc') != $request->nombre_comercial) {
        $this->cambiarNombreDelProvedorALosProductos($proveedor, $request->nombre_comercial);
      };
      $proveedor->save();
      $this->eliminarCacheAllProveedoresPlunk();
      return $proveedor;
    });
  }
  public function destroy($id_proveedor) {
    try { DB::beginTransaction();
      $proveedor = $this->proveedorAsignadoFindOrFailById($id_proveedor, ['contactos', 'productos']);
      $proveedor->delete();
      $this->eliminarCacheAllProveedoresPlunk();

      /// Elimina todos los productos relacionados al proveedor y deja en cero los precios
      $productos = $proveedor->productos()->withTrashed()->with('armados')->get();
      $hastaC = count($productos) - 1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        // Solo modifica los precios si el proveedor eiminado esta relacionado directamente con el producto
        if($productos[$contador2]->prove == $proveedor->nom_comerc) {
          $productos[$contador2]->prove      = null;
          $productos[$contador2]->prec_prove = null;
          $productos[$contador2]->utilid     = null;
          $productos[$contador2]->prec_clien = null;      
          $productos[$contador2]->save();
          
          // CALCULA LOS NUEVOS PRECIOS Y VALORES DEL ARMADO
          $armados = $productos[$contador2]->armados()->withTrashed()->with('productos')->get();
          foreach($armados as $armado) {
            $this->calcularValoresArmadoRepo->calcularValoresArmado($armado, $armado->productos);
          }
        }
      }

      // Manda el registro a la papelera de reciclaje
      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Proveedores', // Nombre del módulo del sistema
        'registro'    => $proveedor->nom_comerc, // Información a mostrar en la papelera
        'tab'         => 'proveedores', // Nombre de la tabla en la BD
        'id_reg'      => $proveedor->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación              
      ]);
      
      DB::commit();
      return $proveedor;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function updateValidado($request, $id_proveedor) {
    try { DB::beginTransaction();
      $proveedor = $this->proveedorAsignadoFindOrFailById($id_proveedor, []);
      $proveedor->prov_valid  = $request->proveedor_validado;

      if($proveedor->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Proveedores', // Módulo
          'proveedor.show', // Nombre de la ruta
          $id_proveedor, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_proveedor), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('¿Proveedor validado?'), // Nombre de los inputs del formulario
          $proveedor, // Request
          array('prov_valid') // Nombre de los campos en la BD
        ); 
        $proveedor->updated_at_prov = Auth::user()->email_registro;
      }
      $proveedor->save();
      $this->eliminarCacheAllProveedoresPlunk();

      DB::commit();
      return $proveedor;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getAllProveedoresPlunk() {
    $proveedores = Cache::rememberForever('allProveedoresPlunk', function() { // Guarda la información en la cache con la llave "allProveedoresPlunk"
      return Proveedor::orderBy('nom_comerc', 'ASC')->pluck('nom_comerc', 'nom_comerc');
    });
    return $proveedores; 
  }
  public function getAllProveedoresPlunkId() {
    return Proveedor::orderBy('nom_comerc', 'ASC')->pluck('nom_comerc', 'id');
  }
  public function getAllProveedoresPlunkMenos($proveedores) {
    return Proveedor::where(function($query) use($proveedores) {
      $hastaC = count($proveedores) -1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        $query->where('id', '!=', $proveedores[$contador2]->id);
      }
    })->orderBy('nom_comerc', 'ASC')->pluck('nom_comerc', 'id');
  }
  public function eliminarCacheAllProveedoresPlunk() {
    Cache::pull('allProveedoresPlunk'); // Elimina la cache con el nombre espesificado
  }
  public function proveedorFindOrFailById($id_proveedor) {
    $id_proveedor = $this->serviceCrypt->decrypt($id_proveedor);
    $proveedor = Proveedor::findOrFail($id_proveedor);
    return $proveedor;
  }
  public function getContactosProveedor($proveedor, $request) {
    if($request->opcion_buscador != null) {
      return $proveedor->contactos()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $proveedor->contactos()->paginate($request->paginador);
  }
  public function cambiarNombreDelProvedorALosProductos($proveedor, $nuevo_nombre_comercial) {
    $hastaC = count($proveedor->productos()->withTrashed()->get()) - 1;
    for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
      if($proveedor->productos[$contador2]->prove == $proveedor->getOriginal('nom_comerc')) {
        $proveedor->productos[$contador2]->prove = $nuevo_nombre_comercial;
        $proveedor->productos[$contador2]->save();
      }
    }
  }
}