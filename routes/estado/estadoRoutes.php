<?php
/* ===================== [ RUTAS (ESTADOS) ] ===================== */
Route::group(['prefix' => 'estado'], function() {
  Route::match(['GET', 'HEAD'],'obtener/{for_loc}', 'Estado\EstadoController@getEstados')->name('estado.getEstados')->middleware('permission:costoDeEnvio.create|costoDeEnvio.edit');
});