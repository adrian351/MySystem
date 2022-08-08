<?php
namespace App\Repositories\proveedor;

interface ProveedorInterface {
    public function proveedorAsignadoFindOrFailById($id_proveedor, $relaciones);
    
    public function getPagination($request);

    public function store($request);

    public function update($request, $id_proveedor);

    public function destroy($id_proveedor);

    public function updateValidado($request, $id_proveedor);

    public function getAllProveedoresPlunk();

    public function getAllProveedoresPlunkId();
    
    public function getAllProveedoresPlunkMenos($proveedores);

    public function eliminarCacheAllProveedoresPlunk();

    public function proveedorFindOrFailById($id_proveedor);

    public function getContactosProveedor($proveedor, $request);

    public function cambiarNombreDelProvedorALosProductos($proveedor, $nuevo_nombre_comercial);
}