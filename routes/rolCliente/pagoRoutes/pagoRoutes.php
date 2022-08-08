<?php
/* ===================== [ RUTAS (PAGOS) ] ===================== */
Route::group(['prefix' => 'pago'], function() {
  Route::match(['GET', 'HEAD'],'', 'RolCliente\Pago\PagoController@index')->name('rolCliente.pago.index');
  Route::match(['GET', 'HEAD'],'registrar', 'RolCliente\Pago\PagoController@create')->name('rolCliente.pago.create');
  Route::post('registrar', 'RolCliente\Pago\PagoController@store')->name('rolCliente.pago.store');
  Route::match(['GET', 'HEAD'],'detalles/{id_pago}', 'RolCliente\Pago\PagoController@show')->name('rolCliente.pago.show');
  Route::match(['GET', 'HEAD'],'editar/{id_pago}', 'RolCliente\Pago\PagoController@edit')->name('rolCliente.pago.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_pago}', 'RolCliente\Pago\PagoController@update')->name('rolCliente.pago.update');
});