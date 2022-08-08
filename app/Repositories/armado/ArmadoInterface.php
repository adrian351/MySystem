<?php
namespace App\Repositories\armado;

interface ArmadoInterface {
    public function armadoAsignadoFindOrFailById($id_armado, $clon, $relaciones);
    
    public function getPagination($request, $clon);

    public function store($request);

    public function update($request, $id_armado, $clon);

    public function destroy($id_armado, $clon);

    public function getArmadosFindOrFail($ids_armados, $hastaC);
    
    public function getProductosProveedor($armado, $request);

    public function getImagenesArmado($armado);
    
    public function getArmadoFindOrFail($id_armado);

    public function getAllArmadosPlunk();

    public function getAllArmados();

    public function getAllArmadosPlunkMenos($armados);

    public function getAllArmadosPlunkMenosId($id_armados);
}