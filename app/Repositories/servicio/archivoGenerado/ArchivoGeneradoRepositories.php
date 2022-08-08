<?php
namespace App\Repositories\servicio\archivoGenerado;
// Models
use App\Models\ArchivoGenerado;
// Exports
// use App\Exports\almacen\producto\generarReporteDeCompraExport;
use App\Exports\almacen\producto\generarReporteDeStockExport;

use App\Exports\usuarioYCliente\UsuariosXLSXExport;
use App\Exports\produccion\reporteProduccionExport;
use App\Exports\almacen\producto\generarReporteDeProductoExport;
// Notifications
use App\Jobs\servicio\NotificarAlUsuarioCuandoTermineLaExportacion;
// Otros
use Illuminate\Support\Facades\Auth;

class ArchivoGeneradoRepositories implements ArchivoGeneradoInterface {
  public function store($info_archivo, $tipo) {
    $usuario = Auth::user();
    $archivo_generado = new ArchivoGenerado();
    $archivo_generado->tip              = $info_archivo->tip;
    $archivo_generado->arch_rut         = $info_archivo->arch_rut;
    $archivo_generado->arch_nom         = $info_archivo->arch_nom;
    $archivo_generado->arch_nom_abrev   = $info_archivo->arch_nom_abrev;
    $archivo_generado->user_id          = $usuario->id;
    $archivo_generado->save();
    $this->tipoExport($tipo, $archivo_generado, $info_archivo, $usuario);
    return $archivo_generado;
  }
  public function tipoExport($tipo, $archivo_generado, $info_archivo, $usuario) {
    // if($tipo == 'generarReporteDeCompraExport') {
    //   (new generarReporteDeCompraExport)->store($archivo_generado->arch_nom, $info_archivo->filesystems, null, ['visibility' => 'public'])->chain([
    //     new NotificarAlUsuarioCuandoTermineLaExportacion($usuario, $archivo_generado)
    //   ]);
    // }
    if($tipo == 'generarReporteDeStockExport') {
      (new generarReporteDeStockExport)->store($archivo_generado->arch_nom, $info_archivo->filesystems, null, ['visibility' => 'public'])->chain([
        new NotificarAlUsuarioCuandoTermineLaExportacion($usuario, $archivo_generado)
      ]);
    }
    if($tipo == 'UsuariosXLSXExport') {
      (new UsuariosXLSXExport)->store($archivo_generado->arch_nom, $info_archivo->filesystems, null, ['visibility' => 'public'])->chain([
        new NotificarAlUsuarioCuandoTermineLaExportacion($usuario, $archivo_generado)
      ]);
    }
    if($tipo == 'reporteProduccionExport') {
      (new reporteProduccionExport)->store($archivo_generado->arch_nom, $info_archivo->filesystems, null, ['visibility' => 'public'])->chain([
        new NotificarAlUsuarioCuandoTermineLaExportacion($usuario, $archivo_generado)
      ]);
    }

    if($tipo == 'generarReporteDeProducto') {
      (new generarReporteDeProductoExport)->store($archivo_generado->arch_nom, $info_archivo->filesystems, null, ['visibility' => 'public'])->chain([
        new NotificarAlUsuarioCuandoTermineLaExportacion($usuario, $archivo_generado)
      ]);
    }

  }
}