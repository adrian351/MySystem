<?php
namespace App\Repositories\servicio\archivoGenerado;

interface ArchivoGeneradoInterface {
    public function store($info_archivo, $tipo);

    public function tipoExport($tipo, $archivo_generado, $info_archivo, $usuario);
}