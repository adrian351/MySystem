<?php
/* ===================== [ RUTAS (COSTOS DE ENVÍO) ] ===================== */
Route::group(['prefix' => 'costo-de-envio'], function() {
  Route::match(['GET', 'HEAD'],'', 'CostoDeEnvio\CostoDeEnvioController@index')->name('costoDeEnvio.index')->middleware('permission:costoDeEnvio.index|costoDeEnvio.create|costoDeEnvio.show|costoDeEnvio.edit|costoDeEnvio.destroy');
  Route::match(['GET', 'HEAD'],'registrar', 'CostoDeEnvio\CostoDeEnvioController@create')->name('costoDeEnvio.create')->middleware('permission:costoDeEnvio.create');
  Route::post('almacenar', 'CostoDeEnvio\CostoDeEnvioController@store')->name('costoDeEnvio.store')->middleware('permission:costoDeEnvio.create');
  Route::match(['GET', 'HEAD'],'detalles/{id_costo}', 'CostoDeEnvio\CostoDeEnvioController@show')->name('costoDeEnvio.show')->middleware('permission:costoDeEnvio.show');
  Route::match(['GET', 'HEAD'],'editar/{id_costo}', 'CostoDeEnvio\CostoDeEnvioController@edit')->name('costoDeEnvio.edit')->middleware('permission:costoDeEnvio.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_costo}', 'CostoDeEnvio\CostoDeEnvioController@update')->name('costoDeEnvio.update')->middleware('permission:costoDeEnvio.edit');
  Route::match(['DELETE'],'eliminar/{id_costo}', 'CostoDeEnvio\CostoDeEnvioController@destroy')->name('costoDeEnvio.destroy')->middleware('permission:costoDeEnvio.destroy');

  Route::match(['GET', 'HEAD'],'obtener', 'CostoDeEnvio\CostoDeEnvioController@obtener')->name('costoDeEnvio.obtener')->middleware('permission:cotizacion.edit');
});