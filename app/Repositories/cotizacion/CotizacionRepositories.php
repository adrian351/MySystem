<?php
namespace App\Repositories\cotizacion;
// Models
use App\Models\Cotizacion;
// Events
use App\Events\layouts\ActividadRegistrada;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
use App\Repositories\sistema\serie\SerieRepositories;
use App\Repositories\cotizacion\CalcularValoresCotizacionRepositories;
use App\Repositories\cotizacion\armadoCotizacion\CalcularValoresArmadoCotizacionRepositories;
use App\Repositories\sistema\sistema\SistemaRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otro
use Illuminate\Support\Facades\Auth;
use DB;

class CotizacionRepositories implements CotizacionInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  protected $serieRepo;
  protected $calcularValoresCotizacionRepo;
  protected $calcularValoresArmadoCotizacionRepo;
  protected $sistemaRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories, SerieRepositories $serieRepositories, CalcularValoresCotizacionRepositories $calcularValoresCotizacionRepositories, CalcularValoresArmadoCotizacionRepositories $calcularValoresArmadoCotizacionRepositories, SistemaRepositories $sistemaRepositories) {
    $this->serviceCrypt                         = $serviceCrypt;
    $this->papeleraDeReciclajeRepo              = $papeleraDeReciclajeRepositories;
    $this->serieRepo                            = $serieRepositories;
    $this->calcularValoresCotizacionRepo        = $calcularValoresCotizacionRepositories;
    $this->calcularValoresArmadoCotizacionRepo  = $calcularValoresArmadoCotizacionRepositories;
    $this->sistemaRepo                          = $sistemaRepositories;
  } 
  public function cotizacionAsignadoFindOrFailById($id_cotizacion, $relaciones = null, $estatus) { // 'armados', 'cliente'
    $id_cotizacion = $this->serviceCrypt->decrypt($id_cotizacion);
    $cotizacion = Cotizacion::with($relaciones)->estatus($estatus)->asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->findOrFail($id_cotizacion);
    return $cotizacion;
  }
  public function cotizacionFindOrFailByNumPedido($num_pedido, $relaciones, $estatus) { // 'armados', 'cliente'
    $num_pedido = $this->serviceCrypt->decrypt($num_pedido);
    $cotizacion = Cotizacion::with($relaciones)->estatus($estatus)->where('num_pedido_gen', $num_pedido)->firstOrFail();
    return $cotizacion;
  }
  public function getPagination($request) {
    return Cotizacion::with('cliente')->asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    // dd($request);
    try { DB::beginTransaction();
      $cotizacion = new Cotizacion();
      $cotizacion->ser             = $this->sistemaRepo->datos('ser_cotizaciones');;
      $cotizacion->serie           = $this->serieRepo->sumaUnoALaUltimaSerie('Cotizaciones (Serie)', $this->sistemaRepo->datos('ser_cotizaciones'));
      $cotizacion->valid           = $request->validez;
      // $cotizacion->desc_cot        = $request->describe_esta_cotizacion_para_que_sea_mas_facil_encontrarla;

      if($request['describe_esta_cotizacion_para_que_sea_mas_facil_encontrarla' ] != null||$request['describe_esta_cotizacion_para_que_sea_mas_facil_encontrarla'] != ''){
        $cotizacion->desc_cot = $request['describe_esta_cotizacion_para_que_sea_mas_facil_encontrarla'];
      }else{
        $cotizacion->desc_cot = 'Sin descripcion';
      }

      $cotizacion->user_id         = $request->cliente;
      $cotizacion->asignado_cot    = Auth::user()->email_registro;
      $cotizacion->created_at_cot  = Auth::user()->email_registro;
      $cotizacion->save();     
      DB::commit();
      return $cotizacion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function update($request, $id_cotizacion) {
    try { DB::beginTransaction();
      $cotizacion = $this->cotizacionAsignadoFindOrFailById($id_cotizacion, [], null);
      $cotizacion->coment = $request->comentarios;
      $cotizacion->coment_vent = $request->comentarios_ventas;

      if($cotizacion->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Cotizaciones', // Módulo
          'cotizacion.show', // Nombre de la ruta
          $id_cotizacion, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_cotizacion), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Comentarios', 'Comentarios ventas'), // Nombre de los inputs del formulario
          $cotizacion, // Request
          array('coment', 'coment_vent') // Nombre de los campos en la BD
        ); 
        $cotizacion->updated_at_cot  = Auth::user()->email_registro;
      }

      $cotizacion->save();     
    DB::commit();
    return $cotizacion;
  } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_cotizacion) {
    try { DB::beginTransaction();
      $cotizacion = $this->cotizacionAsignadoFindOrFailById($id_cotizacion, 'armados', null);
      $cotizacion->delete();

      $this->papeleraDeReciclajeRepo->store([
        'modulo'    => 'Cotizaciones', // Nombre del módulo del sistema
        'registro'  => $cotizacion->serie, // Información a mostrar en la papelera
        'tab'       => 'cotizaciones', // Nombre de la tabla en la BD
        'id_reg'    => $cotizacion->id, // ID de registro eliminado
        'id_fk'     => null // ID de la llave foranea con la que tiene relación           
      ]);
      DB::commit();
      return $cotizacion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function updateIva($request, $id_cotizacion) {
    try { DB::beginTransaction();
      $cotizacion = $this->cotizacionAsignadoFindOrFailById($id_cotizacion, 'armados', config('app.abierta'));
      $cotizacion->con_iva = $request->iva;
      
      if($cotizacion->con_iva == 'on') {
        $opcion = 'Con IVA';
      } elseif($cotizacion->con_iva == null) {
        $opcion = 'Sin IVA';
        $cotizacion->con_com = null;
      }

      if($cotizacion->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Cotizaciones', // Módulo
          'cotizacion.show', // Nombre de la ruta
          $id_cotizacion, // Id del registro debe ir encriptado
          $cotizacion->serie, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('IVA', 'Comisión'), // Nombre de los inputs del formulario
          $cotizacion, // Request
          array('con_iva', 'con_com') // Nombre de los campos en la BD
        ); 
        $cotizacion->updated_at_cot  = Auth::user()->email_registro;
      }

      $cotizacion->save();

      // ELIMINA EL IVA DE TODOS LOS ARMADOS
      foreach($cotizacion->armados as $armado) {
        $armado->con_iva = $opcion;
        $this->calcularValoresArmadoCotizacionRepo->sumaValoresArmadoCotizacion($armado);
        $armado->save();
      }

      // GENERA LOS NUEVOS PRECIOS DE LA COTIZACIÓN
      $this->calcularValoresCotizacionRepo->calculaValoresCotizacion($cotizacion);

      DB::commit();
      return $cotizacion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function updateComision($request, $id_cotizacion) {
    try { DB::beginTransaction();
      $cotizacion = $this->cotizacionAsignadoFindOrFailById($id_cotizacion, [], config('app.abierta'));
      $cotizacion->con_com = $request->comision;

      if($cotizacion->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Cotizaciones', // Módulo
          'cotizacion.show', // Nombre de la ruta
          $id_cotizacion, // Id del registro debe ir encriptado
          $cotizacion->serie, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Comisión'), // Nombre de los inputs del formulario
          $cotizacion, // Request
          array('con_com') // Nombre de los campos en la BD
        ); 
        $cotizacion->updated_at_cot  = Auth::user()->email_registro;
      }

      $cotizacion->save();

      // GENERA LOS NUEVOS PRECIOS DE LA COTIZACIÓN
      $this->calcularValoresCotizacionRepo->calculaValoresCotizacion($cotizacion);

      DB::commit();
      return $cotizacion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getAllCotizacionesValidasPlunk() {
    $dia_actual = date("Y-m-d");
    return Cotizacion::orderBy('id', 'ASC')->where('valid', '>=', $dia_actual)->pluck('serie', 'id');
  }
  public function getCotizacionFindOrFail($id_cotizacion) {
    $id_cotizacion = $this->serviceCrypt->decrypt($id_cotizacion);
    $cotizacion = Cotizacion::with('armados')->findOrFail($id_cotizacion);
    return $cotizacion;
  }
  public function clonar($id_cotizacion) {
    try { DB::beginTransaction();
      $cotizacion = $this->cotizacionAsignadoFindOrFailById($id_cotizacion, 'armados', config('app.abierta'));
      $armados = $cotizacion->armados()->with('productos', 'direcciones')->get();

      // CLONA COTIZACIÓN
      $clonCotizacion                 = $cotizacion->replicate();
      $clonCotizacion->serie          = $this->serieRepo->sumaUnoALaUltimaSerie('Cotizaciones (Serie)', $cotizacion->ser);
      $clonCotizacion->estat          = config('app.abierta');
      $clonCotizacion->valid          = date("Y-m-d", strtotime('+30 day', strtotime(date("Y-m-d"))));
      $clonCotizacion->asignado_cot   = Auth::user()->email_registro;
      $clonCotizacion->created_at_cot = Auth::user()->email_registro;
      $clonCotizacion->updated_at_cot = null;
      $clonCotizacion->created_at     = date("Y-m-d h:i:s");
      $clonCotizacion->updated_at     = null;
      $clonCotizacion->save();
          
      $contador2    = 0;
      $contador3    = 0;
      $contador4    = 0;
      $productos    = null;
      $direcciones  = null;
      foreach($armados as $armado) {
        // CLONA LOS ARMADOS DE LA COTIZACIÓN
        $clonArmado                = $armado->replicate();
        $clonArmado->cotizacion_id = $clonCotizacion->id;
        $clonArmado->created_at    = date("Y-m-d h:i:s");

        if($armado->img_nom != null) {
          // Clona la imagen
          $nueva_ruta = 'cotizacion/'.time().$contador4.'.jpeg';
          $s3 = \Storage::disk("s3");
          $s3->copy($armado->img_nom, $nueva_ruta);
          $clonArmado->img_nom        = $nueva_ruta;
        }

        $clonArmado->save();
        
        // CLONA LOS PRODUCTOS DE LOS ARMADOS
        foreach($armado->productos as $producto) {
          $clonProducto                       = $producto->replicate();
          $productos[$contador2]              = $clonProducto->getAttributes();
          $productos[$contador2]['armado_id'] = $clonArmado->id;
          $productos[$contador2]['created_at']  = date("Y-m-d h:i:s");
          $contador2 +=1;
        }

        // CLONA LAS DIRECCIONES DE LOS ARMADOS
        foreach($armado->direcciones as $direccion) {
          $clonDireccion                        = $direccion->replicate();
          $direcciones[$contador3]              = $clonDireccion->getAttributes();
          $direcciones[$contador3]['armado_id'] = $clonArmado->id;
          $direcciones[$contador3]['created_at']= date("Y-m-d h:i:s");
          $contador3 +=1;
        }
        $contador4 +=1;
      }
      if($productos != null) {
        \App\Models\CotizacionArmadoProductos::insert($productos);
      }
      if($direcciones != null) {
        \App\Models\CotizacionArmadoTieneDirecciones::insert($direcciones);
      }
      DB::commit();
      return $clonCotizacion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function cancelar($id_cotizacion) {
    try { DB::beginTransaction();
      $cotizacion = $this->cotizacionAsignadoFindOrFailById($id_cotizacion, [], config('app.abierta'));
      $cotizacion->estat = config('app.cancelada');
      $cotizacion->save();
      DB::commit();
      return $cotizacion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}