<?php
/* ===================== [ RUTAS SISTEMA (ACTIVIDAD) ] ===================== */
Route::group(['prefix' => 'actividad'], function() {
  Route::match(['GET', 'HEAD'],'', 'Sistema\ActividadController@index')->name('sistema.actividad.index')->middleware('permission:sistema.actividad.index');
});