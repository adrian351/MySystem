<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Producto extends Model {
  use SoftDeletes;
  use SoftCascadeTrait;

  protected $table = 'productos';
  protected $primaryKey = 'id';
  protected $guarded = [];

  protected $dates = ['deleted_at'];
  protected $softCascade = ['precios', 'imagenes']; // SE INDICAN LOS NOMBRES DE LAS RELACIONES CON LA QUE TENDRA BORRADO EN CASCADA

  // Define si vera todos los registros de la tabla o solo los que se le asignaron o los que usuario registro (on = todos los registros null = solo sus registros)
  public function scopeAsignado($query, $opcion_asignado, $usuario) {
    if($opcion_asignado == null) {
      return $query->where('asignado_prod', $usuario);
    }
  }
  // Buscador
  public function scopeBuscar($query, $opcion_buscador, $buscador) {
    if($opcion_buscador != null) {
      return $query->where("$opcion_buscador", 'LIKE', "%$buscador%");
    }
  }
  public function armados(){
    return $this->belongsToMany('App\Models\Armado', 'armado_tiene_productos')->withPivot('id', 'cant')->orderBy('armado_tiene_productos.id', 'DESC');
  } 
  public function sustitutos(){
    return $this->belongsToMany('App\Models\Producto', 'producto_tiene_sustitutos', 'producto_id', 'sustituto_id')->withPivot('id')->withTimestamps()->orderBy('producto_tiene_sustitutos.id', 'DESC');
  }
  public function proveedores(){
    return $this->belongsToMany('App\Models\Proveedor', 'producto_tiene_proveedores')->withPivot('id', 'prec_prove', 'utilid', 'prec_clien', 'produc', 'cod_fabricante', 'tip_iva', 'ieps')->withTimestamps()->orderBy('producto_tiene_proveedores.id', 'DESC');
  }
  public function precios(){
    return $this->hasMany('App\Models\PrecioPorYear')->orderBy('id', 'DESC');
  }
  public function productos_pedido(){
    return $this->belongsToMany('App\Models\PedidoArmadoTieneProducto', 'prod_orig_tiene_prod_ped')->withTimestamps();
  }
  public function catalogos(){
    return $this->belongsToMany('App\Models\Catalogo', 'producto_catalogo');
  }

  public function categoria(){
  return $this->belongsToMany(Categoria::class, 'producto_has_categoria', 'producto_id', 'categoria_id');
  }

  public function subcategoria(){
    return $this->belongsToMany(SubCategoria::class, 'producto_has_subcategoria', 'producto_id', 'subcategoria_id');
  }

  public function etiqueta(){
    return $this->belongsToMany(Etiqueta::class, 'producto_has_etiqueta', 'producto_id', 'etiqueta_id');
  }
  public function imagenes(){
    return $this->hasMany('App\Models\ProductoImagen')->orderBy('id', 'DESC');
  } 
}