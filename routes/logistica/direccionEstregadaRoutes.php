<?php
/* ===================== [ RUTAS LOGÍSTICA (DIRECCIÓN ENTREGADA) ] ===================== */
Route::group(['prefix' => 'direccion-entregada'], function() {
  Route::match(['GET', 'HEAD'],'', 'Logistica\DireccionEntregada\DireccionEntregadaController@index')->name('logistica.direccionEntregada.index')->middleware('permission:logistica.pedidoEntregado.index|logistica.pedidoEntregado.show|logistica.direccionEntregada.edit');
  Route::match(['GET', 'HEAD'],'detalles/{id_direccion}', 'Logistica\DireccionEntregada\DireccionEntregadaController@show')->name('logistica.direccionEntregada.show')->middleware('permission:logistica.pedidoEntregado.show');
  Route::match(['GET', 'HEAD'],'regresar-en-ruta/{id_direccion}', 'Logistica\DireccionEntregada\DireccionEntregadaController@regresarEnRuta')->name('logistica.direccionEntregada.regresarEnRuta')->middleware('permission:logistica.direccionEntregada.edit');
});