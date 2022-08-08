<?php
namespace App\Repositories\material;
// Models
use App\Models\Material;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class MaterialRepositories implements MaterialInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt = $serviceCrypt;
  } 
  public function materialAsignadoFindOrFailById($id_material, $relaciones) {
    $id_material = $this->serviceCrypt->decrypt($id_material);
    $material = Material::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->with($relaciones)->findOrFail($id_material);
    return $material;
  }
  public function getPagination($request) {
    return Material::asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try { DB::beginTransaction();
      $material = new Material();
      $material->sku                = $request->sku;
      $material->des                = $request->descripcion_en_ingles;
      $material->lob                = $request->lob;
      $material->produc_lin         = $request->product_line;
      $material->produc_lin_sub_gro = $request->product_line_sub_group;
      $material->fam_de_prod        = $request->familia_de_producto;
      $material->lin_de_prod        = $request->linea_de_producto;
      $material->sub_lin_de_prod    = $request->sub_linea_de_producto;
      $material->prec_list_pag      = $request->precio_lista_pagina;
      $material->desc               = $request->descuento;
      $material->prec_pag_al_cli    = $request->precio_pagina_al_cliente;
      $material->asignado_mat       = Auth::user()->email_registro;
      $material->created_at_mat     = Auth::user()->email_registro;
      $material->save();
     
      DB::commit();
      return $material;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function update($request, $id_material) {
    try { DB::beginTransaction();
      $material = $this->materialAsignadoFindOrFailById($id_material, []);
      $material->sku                = $request->sku;
      $material->des                = $request->descripcion_en_ingles;
      $material->lob                = $request->lob;
      $material->produc_lin         = $request->product_line;
      $material->produc_lin_sub_gro = $request->product_line_sub_group;
      $material->fam_de_prod        = $request->familia_de_producto;
      $material->lin_de_prod        = $request->linea_de_producto;
      $material->sub_lin_de_prod    = $request->sub_linea_de_producto;
      $material->prec_list_pag      = $request->precio_lista_pagina;
      $material->desc               = $request->descuento;
      $material->prec_pag_al_cli    = $request->precio_pagina_al_cliente;

      if($material->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Materiales', // Módulo
          'material.show', // Nombre de la ruta
          $id_material, // Id del registro debe ir encriptado
          $material->sku, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('SKU', 'Descripción en ingles', 'Lob', 'Product Line', 'Product Line Sub-Group', 'Familia de producto', 'Línea de producto', 'Sub Línea de producto', 'Precio Lista Pagina', 'Descuento', 'Precio Pagina (Al cliente)'), // Nombre de los inputs del formulario
          $material, // Request
          array('sku', 'des', 'lob', 'produc_lin', 'produc_lin_sub_gro', 'fam_de_prod', 'lin_de_prod', 'sub_lin_de_prod', 'prec_list_pag', 'desc', 'prec_pag_al_cli') // Nombre de los campos en la BD
        ); 
        $material->updated_at_mat  = Auth::user()->email_registro;
      }
     
      $material->save();
      DB::commit();
      return $material;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_material) {
    try { DB::beginTransaction();
      $material = $this->materialAsignadoFindOrFailById($id_material, []);
      $material->forceDelete();
    
      DB::commit();
      return $material;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getAllMaterialesPlunk() {
    return Material::orderBy('sku', 'ASC')->pluck('sku', 'id');
  }
  public function getMaterialFind($id_material) {
    $material = Material::find($id_material);
    return $material;
  }
}