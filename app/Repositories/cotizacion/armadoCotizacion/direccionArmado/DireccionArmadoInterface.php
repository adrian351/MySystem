<?php
namespace App\Repositories\cotizacion\armadoCotizacion\direccionArmado;

interface DireccionArmadoInterface {
    public function direccionFindOrFailById($id_direccion);

    public function store($request, $id_armado);

    public function update($request, $id_direccion);

    public function destroy($id_direccion);
}