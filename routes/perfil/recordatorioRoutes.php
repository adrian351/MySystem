<?php
/* ===================== [ RUTAS PERFIL (RECORDATORIOS) ] ===================== */
Route::group(['prefix' => 'recordatorio'], function() {
    Route::match(['GET', 'HEAD'],'', 'Perfil\Recordatorio\RecordatorioController@index')->name('perfil.recordatorio.index');
});