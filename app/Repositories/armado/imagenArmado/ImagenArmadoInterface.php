<?php
namespace App\Repositories\armado\imagenArmado;

interface ImagenArmadoInterface {
    public function imagenArmadoFindOrFailById($id_imagen, $relaciones);
    
    public function store($request, $id_armado);

    public function destroy($id_imagen);
}