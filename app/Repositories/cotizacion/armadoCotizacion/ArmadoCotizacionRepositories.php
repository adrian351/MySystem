<?php
namespace App\Repositories\cotizacion\armadoCotizacion;
// Models
use App\Models\CotizacionArmado;
use App\Models\Armado;
// Events
use App\Events\layouts\ArchivosEliminados;
use App\Events\layouts\ActividadRegistrada;
// Repositories
use App\Repositories\armado\ArmadoRepositories;
use App\Repositories\cotizacion\CotizacionRepositories;
use App\Repositories\cotizacion\CalcularValoresCotizacionRepositories;
use App\Repositories\cotizacion\armadoCotizacion\productoArmado\StoreFilesRepositories;
use App\Repositories\cotizacion\armadoCotizacion\CalcularValoresArmadoCotizacionRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ArmadoCotizacionRepositories implements ArmadoCotizacionInterface {
  protected $serviceCrypt;
  protected $armadoRepo;
  protected $cotizacionRepo;
  protected $calcularValoresCotizacionRepo;
  protected $storeFilesRepo;
  protected $calcularValoresArmadoCotizacionRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ArmadoRepositories $armadoRepositories, CotizacionRepositories $cotizacionRepositories, CalcularValoresCotizacionRepositories $calcularValoresCotizacionRepositories, StoreFilesRepositories $storeFilesRepositories, CalcularValoresArmadoCotizacionRepositories $calcularValoresArmadoCotizacionRepositories) {
    $this->serviceCrypt                         = $serviceCrypt;
    $this->armadoRepo                           = $armadoRepositories;
    $this->cotizacionRepo                       = $cotizacionRepositories;
    $this->calcularValoresCotizacionRepo        = $calcularValoresCotizacionRepositories;
    $this->storeFilesRepo                       = $storeFilesRepositories;
    $this->calcularValoresArmadoCotizacionRepo  = $calcularValoresArmadoCotizacionRepositories;
  }
  public function armadoFindOrFailById($id_armado, $relaciones) { // 'cotizacion', 'productos', 'direcciones'
    $id_armado = $this->serviceCrypt->decrypt($id_armado);
    $armado = CotizacionArmado::with($relaciones)->findOrFail($id_armado);
    return $armado;
  }
  public function store($request, $id_cotizacion) {
    DB::transaction(function() use($request, $id_cotizacion) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $cotizacion = $this->cotizacionRepo->cotizacionAsignadoFindOrFailById($id_cotizacion, [], config('app.abierta'));
      $armado     = $this->armadoRepo->getArmadoFindOrFail($request->id_armado);
      $this->verificarElEstatusDeLaCotizacion($cotizacion->estat);
      $cant = (int)$request->cantidad_stock;
      $usar_stock = $request->usar_stock;
      
      // GUARDA EL REGISTRO DEL ARMADO
      $cot_armado = new CotizacionArmado();
      if($usar_stock == 'Si' && $cant < 1){
        return abort(404, 'No se puede usar de stock. El stock esta vacío.');
      }
      if($armado->img_nom_min != null) {
        // Clona la imagen
        $nueva_ruta = 'cotizacion/'.time().'.jpeg';
        $s3 = \Storage::disk("s3");
        $s3->copy($armado->img_nom_min, $nueva_ruta);
        $cot_armado->img_rut        = $armado->img_rut_min;
        $cot_armado->img_nom        = $nueva_ruta;
      }
      
      $cot_armado->id_armado      = $armado->id;
      $cot_armado->tip            = $armado->tip;
      $cot_armado->nom            = $armado->nom;
      $cot_armado->sku            = $armado->sku;
      $cot_armado->gama           = $armado->gama;
      $cot_armado->es_de_stock    = $request->usar_stock;
      // $cot_armado->arm_de_cat     = $armado->arm_de_act;
      $cot_armado->dest           = $armado->dest;
      $cot_armado->tam            = $armado->tam;
      $cot_armado->pes            = $armado->pes;
      $cot_armado->alto           = $armado->alto;
      $cot_armado->ancho          = $armado->ancho;
      $cot_armado->largo          = $armado->largo;
      $cot_armado->prec_de_comp   = $armado->prec_de_comp;
      $cot_armado->prec_origin    = $armado->prec_origin;
      $cot_armado->desc_esp       = $armado->desc_esp;
      $cot_armado->prec_redond    = $armado->prec_redond;
      $cot_armado->sub_total      = $armado->prec_redond;

      if( $cotizacion->con_iva == 'on') {
        $cot_armado->iva          = $cot_armado->sub_total * .16;
      } else {
        $cot_armado->iva          = 0;
      }

      $cot_armado->tot            = $cot_armado->sub_total + $cot_armado->iva;
      $cot_armado->cotizacion_id  = $cotizacion->id;
      $cot_armado->created_at_arm = Auth::user()->email_registro;
      $cot_armado->save();

      // Agrega los productos del armado al armado de la cotización
      $this->storeFilesRepo->storeProductos($armado->productos, $cot_armado->id);

       // GENERA LOS NUEVOS PRECIOS DE LA COTIZACIÓN
       $this->calcularValoresCotizacionRepo->calculaValoresCotizacion($cotizacion);
    });
  }
  public function update($request, $id_armado) {
    try { DB::beginTransaction();
      $armado     = $this->armadoFindOrFailById($id_armado, 'cotizacion');
      $this->verificarElEstatusDeLaCotizacion($armado->cotizacion->estat);
      $cotizacion = $armado->cotizacion;

      // ACTUALIZA Y GENERA LOS NUEVOS PRECIOS DEL ARMADO
      $armado->es_de_regalo = $request->es_de_regalo;
      $armado->cant         = $request->cantidad;
      $armado->tip_desc     = $request->tipo_de_descuento;
      $armado->manu         = $request->manual;
      $armado->porc         = $request->porcentaje;
      $armado               = $this->calcularValoresArmadoCotizacionRepo->sumaValoresArmadoCotizacion($armado);

      if($armado->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Cotizaciones (Armado)', // Módulo
          'cotizacion.armado.show', // Nombre de la ruta
          $id_armado, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_armado), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('¿Es de regalo?', 'Cantidad', 'Tipo de descuento', 'Manual', 'Porcenjate', 'Descuento', 'Subtotal', 'IVA', 'Total'), // Nombre de los inputs del formulario
          $armado, // Request
          array('es_de_regalo', 'cant', 'tip_desc', 'manu', 'porc', 'desc', 'sub_total', 'iva', 'tot') // Nombre de los campos en la BD
        ); 
        $armado->updated_at_arm  = Auth::user()->email_registro;
      }
      $armado->save();

      // GENERA LOS NUEVOS PRECIOS DE LA COTIZACIÓN
      $this->calcularValoresCotizacionRepo->calculaValoresCotizacion($cotizacion);

      DB::commit();
      return $armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_armado) {
    try { DB::beginTransaction();
      $armado     = $this->armadoFindOrFailById($id_armado, 'cotizacion');
      $this->verificarElEstatusDeLaCotizacion($armado->cotizacion->estat);
      $cotizacion = $armado->cotizacion;
      $armado->forceDelete();

      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      ArchivosEliminados::dispatch(
        array($armado->img_nom), 
      );

      // GENERA LOS NUEVOS PRECIOS DE LA COTIZACIÓN
      $this->calcularValoresCotizacionRepo->calculaValoresCotizacion($cotizacion);

      // IMPORTANTE NO SE IMPLEMENTARA PAPELERA DE RECICLAJE (POR LOS PRECIOS DE LOS ARMADOS RELACIONADOS A LA COTIZACIÓN)
      
      DB::commit();
      return $armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function verificarSiYaFueModificado($armado, $cotizacion) {
    if($armado->ya_mod == '0') {
      $armado->nom .= ' ('.substr($cotizacion->cliente->nom, 0, 15) .')';
      $armado->ya_mod = '1';
    }
    return $armado;
  }
  public function verificarElEstatusDeLaCotizacion($estatus) {
    if($estatus != config('app.abierta')) { 
      return abort(404); 
    }
  }
  public function clonar($id_armado) { 
    try { DB::beginTransaction();
      $armado = $this->armadoFindOrFailById($id_armado, 'productos');
      $clon_armado                  = new \App\Models\Armado();
      $clon_armado->clon            = '1'; // 1=Si
      $clon_armado->tip             = $armado->tip;
      $clon_armado->nom             = $armado->nom. '- clon'.time();
      $clon_armado->sku             = $armado->sku. '- clon'.time();
      $clon_armado->gama            = $armado->gama;
      // $clon_armado->arm_de_cat      = $armado->arm_de_act;
      $clon_armado->dest            = $armado->dest;
      $clon_armado->prec_de_comp    = $armado->prec_de_comp;
      $clon_armado->prec_origin     = $armado->prec_origin;
      $clon_armado->desc_esp        = $armado->desc_esp;
      $clon_armado->prec_redond     = $armado->prec_redond;
      $clon_armado->tam             = $armado->tam;
      $clon_armado->pes             = $armado->pes;
      $clon_armado->alto            = $armado->alto;
      $clon_armado->ancho           = $armado->ancho;
      $clon_armado->largo           = $armado->largo;
      $clon_armado->asignado_arm    = Auth::user()->email_registro;
      $clon_armado->created_at_arm  = Auth::user()->email_registro;
      $clon_armado->save();

      // CLONA LOS PRODUCTOS DEL ARMADO
      $datos = null;
      foreach($armado->productos as $producto_armado) {
        $datos[$producto_armado->id_producto] = [
          'cant' => $producto_armado->cant,
        ];
      }
      $clon_armado->productos()->sync($datos);

      DB::commit();
      return $clon_armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }

  public function getStockArmado($armado){
    $stock_armado = Armado::select('id', 'stock')->where('id', '=', $armado->id_armado)->get();
    return $stock_armado[0];
  }
  
// public function disminuirStockArmados($cotizacion, $armado, $status){
//   $stock = $armado->stocks();

//   if($status != config('app.abierta')){
//     $stock->cant - $cotizacion->armados;
//   }

//   return $stock;
// }

}