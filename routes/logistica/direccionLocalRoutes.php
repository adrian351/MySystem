<?php
/* ===================== [ RUTAS LOGÍSTICA (ARMADOS LOCALES) ] ===================== */
Route::group(['prefix' => 'local'], function() {
  Route::match(['GET', 'HEAD'],'', 'Logistica\DireccionLocal\DireccionLocalController@index')->name('logistica.direccionLocal.index')->middleware('permission:logistica.direccionLocal.index|logistica.direccionLocal.show|logistica.direccionLocal.create|logistica.direccionLocal.createEntrega|logistica.direccionLocal.edit');
  Route::match(['GET', 'HEAD'],'detalles/{id_direccion}', 'Logistica\DireccionLocal\DireccionLocalController@show')->name('logistica.direccionLocal.show')->middleware('permission:logistica.direccionLocal.show');
  Route::match(['GET', 'HEAD'],'editar/{id_direccion}', 'Logistica\DireccionLocal\DireccionLocalController@edit')->name('logistica.direccionLocal.edit')->middleware('permission:logistica.direccionLocal.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_direccion}', 'Logistica\DireccionLocal\DireccionLocalController@update')->name('logistica.direccionLocal.update')->middleware('permission:logistica.direccionLocal.edit');

  Route::match(['GET', 'HEAD'],'generar-reporte', 'Logistica\DireccionLocal\DireccionLocalController@generarReporte')->name('logistica.direccionLocal.generarReporte')->middleware('permission:logistica.direccionLocal.index');

  Route::group(['prefix' => 'comprobante-de-salida'], function() {
    Route::match(['GET', 'HEAD'],'registrar/{id_direccion}', 'Logistica\DireccionLocal\DireccionLocalController@create')->name('logistica.direccionLocal.create')->middleware('permission:logistica.direccionLocal.create');
    Route::post('almacenar/{id_direccion}', 'Logistica\DireccionLocal\DireccionLocalController@store')->name('logistica.direccionLocal.store')->middleware('permission:logistica.direccionLocal.create|logistica.direccionForaneo.create');
  });

  Route::group(['prefix' => 'comprobante-de-entrega'], function() {
    Route::match(['GET', 'HEAD'],'registrar/{id_comprobante}', 'Logistica\DireccionLocal\DireccionLocalController@createEntrega')->name('logistica.direccionLocal.createEntrega')->middleware('permission:logistica.direccionLocal.create|logistica.direccionLocal.createEntrega|logistica.direccionLocFor.createEntrega');
    Route::post('almacenar/{id_comprobante}', 'Logistica\DireccionLocal\DireccionLocalController@storeEntrega')->name('logistica.direccionLocal.storeEntrega')->middleware('permission:logistica.direccionLocal.create|logistica.direccionLocal.createEntrega|logistica.direccionForaneo.create|logistica.direccionForaneo.createEntrega|logistica.direccionLocFor.createEntrega');
  });
});
