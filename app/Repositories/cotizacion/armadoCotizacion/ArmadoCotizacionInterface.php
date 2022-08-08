<?php
namespace App\Repositories\cotizacion\armadoCotizacion;

interface ArmadoCotizacionInterface {
    public function armadoFindOrFailById($id_armado, $relaciones);

    public function store($request, $id_cotizacion);

    public function update($request, $id_armado);

    public function destroy($id_armado);

    public function verificarSiYaFueModificado($armado, $cotizacion);

    public function verificarElEstatusDeLaCotizacion($estatus);

    public function clonar($id_armado);
}