<?php
namespace App\Http\Requests\almacen\producto;
use Illuminate\Foundation\Http\FormRequest;
// Otros
use Illuminate\Support\Facades\Crypt;

class UpdateProductoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_producto = Crypt::decrypt($this->id_producto);
    return [
      'imagen_del_producto'       => 'nullable|max:1024|image',
      'nombre_del_producto'       => 'required|max:70|unique:productos,produc,'. $id_producto,
      'es_producto_de_catalogo'   => 'required|in:Producto de catálogo,Producto externo,Producto de despensa',
    //  'codigo_de_fabricante'      => 'nullable|max:100',
    //  'tipo_de_iva'               => 'nullable|in:on,off',
    //  'ieps'                      => 'nullable|in:on,off',
      'minimo_de_venta'           => 'nullable|numeric|alpha_decimal15',
      'publicado_en_tienda_gourmet' => 'required|in:Si,No',
      'marca'                     => 'required|max:150|exists:catalogos,value',
      'tipo'                      => 'required|in:Producto,Canasta',
      'tamano'                    => 'nullable|required_if:tipo,Canasta|in:Chico,Mediano,Grande',
      'alto'                      => 'nullable|required_if:tipo,Canasta|min:0|numeric|alpha_decimal7',
      'ancho'                     => 'nullable|required_if:tipo,Canasta|min:0|numeric|alpha_decimal7',
      'largo'                     => 'nullable|required_if:tipo,Canasta|min:0|numeric|alpha_decimal7',
      'costo_de_armado'           => 'nullable|required_if:tipo,Canasta|min:0|numeric|alpha_decimal15',
      'nombre_del_proveedor'      => 'required|exists:proveedores,nom_comerc',
      // 'categoria'                 => 'required|max:150',
      // 'etiqueta'                  => 'nullable|exists:catalogos,id|array',
      'peso'                      => 'required|min:0|numeric|alpha_decimal7',
      'codigo_de_barras'          => 'nullable|max:250',
      'cantidad_minima_de_stock'  => 'nullable|min:0|numeric|max:99999',
      'descripcion_del_producto'  => 'nullable|max:30000|string',
    ];
  }
  public function attributes() {
    return [
      // Nombre del campo a mostrar.
      'tamano'    => 'tamaño',
    ];
  }
}