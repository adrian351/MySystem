<?php
namespace App\Repositories\almacen\producto;

interface ProductoInterface {
    public function productoAsignadoFindOrFailById($id_producto, $relaciones);

    public function getPagination($request);

    public function store($request);
    
    public function update($request, $id_producto);

    public function updateValidado($request, $id_producto);
    
    public function updateHabilitado($request, $id_producto);
    
    public function aumentarStock($request, $id_producto);

    public function disminuirStock($request, $id_producto);

    public function destroy($id_producto);

    public function getSustitutosProducto($producto, $request);

    public function getproductoFindOrFailById($id_producto, $relaciones);

    public function getproductoFindWithTrashed($id_producto, $relaciones);
    
    public function getproductoFindById($id_producto, $relaciones);

    public function eliminarCacheAllProductosPlunk();

    public function getAllProductosPlunk();

    public function getAllSustitutosOrProductosPlunkMenos($sustitutos_o_productos, $opcion);

    public function getAllSustitutosOrProductosMenos($sustitutos_o_productos, $opcion);
    
    public function getProductosFindOrFail($ids_productos, $hastaC);

    public function getExistenciaEquivalentePorProducto($sustitutos);

    public function getProveedoresProducto($producto, $request);
}