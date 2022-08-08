<?php
/* ===================== [ RUTAS PERFIL (ARCHIVOS GENERADOS) ] ===================== */
Route::group(['prefix' => 'archivos-generados'], function() {
    Route::match(['GET', 'HEAD'],'', 'Perfil\ArchivoGenerado\ArchivoGeneradoController@index')->name('perfil.archivoGenerado.index');
});