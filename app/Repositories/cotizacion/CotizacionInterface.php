<?php
namespace App\Repositories\cotizacion;

interface CotizacionInterface {
    public function cotizacionAsignadoFindOrFailById($id_cotizacion, $relaciones, $estatus);

    public function cotizacionFindOrFailByNumPedido($num_pedido, $relaciones, $estatus);

    public function getPagination($request);

    public function store($request);

    public function update($request, $id_cotizacion);
    
    public function destroy($id_cotizacion);

    public function updateIva($request, $id_cotizacion);

    public function getAllCotizacionesValidasPlunk();

    public function getCotizacionFindOrFail($id_cotizacion);

    public function clonar($id_cotizacion);

    public function cancelar($id_cotizacion);
}