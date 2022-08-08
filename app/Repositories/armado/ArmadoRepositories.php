<?php
namespace App\Repositories\armado;
// Models
use App\Models\Armado;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
use App\Repositories\servicio\calculo\CalculoRepositories;
use App\Repositories\armado\CalcularValoresArmadoRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;
use Intervention\Image\ImageManagerStatic as Image;
use Storage;

class ArmadoRepositories implements ArmadoInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  protected $calculoRepo;
  protected $calcularValoresArmadoRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories, CalculoRepositories $calculoRepositories, CalcularValoresArmadoRepositories $calcularValoresArmadoRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->papeleraDeReciclajeRepo  = $papeleraDeReciclajeRepositories;
    $this->calculoRepo              = $calculoRepositories;
    $this->calcularValoresArmadoRepo  = $calcularValoresArmadoRepositories;
  }
  public function armadoAsignadoFindOrFailById($id_armado, $clon, $relaciones = null) { // 'productos', 'imagenes'
    $id_armado = $this->serviceCrypt->decrypt($id_armado);
    $armado = Armado::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->where('clon', $clon)->with($relaciones)->findOrFail($id_armado);
    return $armado;
  }
  public function getPagination($request, $clon) {
    return Armado::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->where('clon', $clon)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try { DB::beginTransaction();
      $armado = new Armado();
      $armado->clon            = '0'; // 1=Si
      $armado->tip             = $request->tipo;
      $armado->nom             = $request->nombre;
      $armado->sku             = $request->sku;
      // $armado->skuArmado       = $request->id;
      $armado->arm_de_cat      = $request->arm_de_cat;
      // $armado->gama            = $request->gama;
      if($request['gama'] != null || $request['gama'] != '') {
        $armado->gama = $request->gama;
      }else{
        $request->gama = 'Sin gama';
      }

      // $armado->dest            = $request->destacado;
      if($request['destacado'] != null || $request['destacado'] != ''){
        $armado->dest = $request->destacado;
      }else{
        $request->armado = 'No';
      }
      $armado->url_pagina      = $request->url_pagina;
      $armado->obs             = $request->observaciones;
      $armado->asignado_arm    = Auth::user()->email_registro;
      $armado->created_at_arm  = Auth::user()->email_registro;
      if($request->hasfile('imagen_del_armado')) {
        $imagen_blob = request()->file('imagen_del_armado');

        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $imagen_blob, // Archivo blob
          'armados/'.date("Y"), // Ruta en la que guardara el archivo
          'armado-'.time().'.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        ); 
        $armado->img_rut = $imagen[0]['ruta'];
        $armado->img_nom = $imagen[0]['nombre'];

        // Minimiza el tamaño de la imagen
        $img = Image::make($imagen_blob);
        $img_nom = $imagen_blob->getClientOriginalName();
        $img->resize(200, 200, function ($constraint) {
          $constraint->aspectRatio();
        });
        $imagen_blob_min = $img->stream()->detach();
        $nom = 'armados/'.date("Y").'/'.time().'min'.$img_nom;
        Storage::disk('s3')->put($nom, $imagen_blob_min, 'public');
        $armado->img_rut_min = $imagen[0]['ruta'];
        $armado->img_nom_min = $nom;
      }
      $armado->save();
      $armado->marca()->detach();
      $armado->marca()->sync($request->marca);
      DB::commit();
      return $armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }

  private function armadoCatalogo($request, $armado){
      $armado->arm_de_cat  = $request->arm_de_cat;
      $armado->save();
  }

  public function update($request, $id_armado, $clon) {
    DB::transaction(function() use($request, $id_armado, $clon) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $armado = $this->armadoAsignadoFindOrFailById($id_armado, $clon, ['productos']);
      $armado->tip         = $request->tipo;
      $armado->nom         = $request->nombre;
      $armado->sku         = $request->sku;
      if(Auth::user()->can('armado.catalogo.select')){
       $this->armadoCatalogo($request, $armado);
      }
      $armado->gama        = $request->gama;
      if($request->operacion == 'sumar'){
        $armado->stock       += $request->stock_armado;
      }else{
        $armado->stock       -= $request->stock_armado;
      }
      $armado->dest        = $request->destacado;
      $armado->url_pagina  = $request->url_pagina;
      $armado->desc_esp    = $request->descuento_especial;
      $armado->obs         = $request->observaciones;

      if($armado->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        if($clon == '0') {
          $modulo = 'Armados';
          $nom_ruta = 'armado.show';
        }elseif($clon == '1') {
          $modulo = 'Armados clonados';
          $nom_ruta = 'armado.clon.show';
        }
        ActividadRegistrada::dispatch(
          $modulo, // Módulo
          $nom_ruta, // Nombre de la ruta
          $id_armado, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_armado), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Tipo', 'Nombre', 'SKU', 'Gama', 'Stock', '¿Es armado de catálogo?', 'Destacado', 'URL página', 'Descuento especial', 'Observaciones'), // Nombre de los inputs del formulario
          $armado, // Request
          array('tip', 'nom', 'sku', 'gama', 'stock', 'arm_de_cat', 'dest', 'url_pagina', 'desc_esp', 'obs') // Nombre de los campos en la BD
        ); 
        $armado->updated_at_arm  = Auth::user()->email_registro;
      }
      if($request->hasfile('imagen_del_armado')) {
        $imagen_blob = $request->file('imagen_del_armado');

        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $imagen_blob, 
          'armados/'.date("Y"), 
          'armado-'.time().'.',
          [$armado->img_nom, $armado->img_nom_min],
        ); 
        $armado->img_rut = $imagen[0]['ruta'];
        $armado->img_nom = $imagen[0]['nombre'];

        // Minimiza el tamaño de la imagen
        $img = Image::make($imagen_blob);
        $img_nom = $imagen_blob->getClientOriginalName();
        $img->resize(200, 200, function ($constraint) {
          $constraint->aspectRatio();
        });
        $imagen_blob_min = $img->stream()->detach();
        $nom = 'armados/'.date("Y").'/'.time().'min'.$img_nom;
        Storage::disk('s3')->put($nom, $imagen_blob_min, 'public');
        $armado->img_rut_min = $imagen[0]['ruta'];
        $armado->img_nom_min = $nom;
      }
     
      $armado->save();
      // edit armado 
      $armado->marca()->detach();
      $armado->marca()->sync($request->marca);

      $armado = $this->calcularValoresArmadoRepo->calcularValoresArmado($armado, $armado->productos);
      return $armado;
    });
  }
  public function destroy($id_armado, $clon) {
    try { DB::beginTransaction();
      $armado = $this->armadoAsignadoFindOrFailById($id_armado, $clon, []);
      $armado->marca()->detach();
      $armado->delete();
      $armado->marca()->detach();
      if($clon == '0') {
        $modulo = 'Armados';
      }elseif($clon == '1') {
        $modulo = 'Armados clonados';
      }
      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => $modulo, // Nombre del módulo del sistema
        'registro'    => $armado->nom , // Información a mostrar en la papelera
        'tab'         => 'armados', // Nombre de la tabla en la BD
        'id_reg'      => $armado->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación           
      ]);
      DB::commit();
      
      
      return $armado;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getArmadosFindOrFail($ids_armados, $hastaC) {
    for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
      $armados[$contador2] = Armado::where('id', $ids_armados[$contador2])->first();
    }
    return $armados;
  }
  public function getProductosProveedor($armado, $request) {
    if($request->opcion_buscador != null) {
      return $armado->productos()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $armado->productos()->paginate($request->paginador);
  }
  public function getImagenesArmado($armado) {
    return $armado->imagenes()->paginate(99999999);
  }
  public function getArmadoFindOrFail($id_armado) {
    return Armado::with('productos')->findOrFail($id_armado);
  }
  public function getAllArmadosPlunk() {
    return Armado::orderBy('nom', 'ASC')->pluck('nom', 'id');
  }
  public function getAllArmados() {
    return Armado::orderBy('nom', 'ASC')->get(['nom', 'id', 'sku', 'arm_de_cat', 'stock']);
  }
  public function getAllArmadosPlunkMenos($armados) {
    return Armado::where(function($query) use($armados) {
      $hastaC = count($armados) -1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        $query->where('id', '!=', $armados[$contador2]->id_armado);
      }
    })->orderBy('nom', 'ASC')->pluck('nom', 'id');
  }
  public function getAllArmadosPlunkMenosId($id_armados) {
    return Armado::where(function($query) use($id_armados) {
      $hastaC = count($id_armados) -1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        $query->where('id', '!=', $id_armados);
      }
    })->orderBy('nom', 'ASC')->pluck('nom', 'id');
  }
}