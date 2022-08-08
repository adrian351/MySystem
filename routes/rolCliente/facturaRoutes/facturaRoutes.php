<?php
/* ===================== [ RUTAS (FACTURA) ] ===================== */
Route::group(['prefix' => 'factura'], function() {
  Route::match(['GET', 'HEAD'],'', 'RolCliente\Factura\FacturaController@index')->name('rolCliente.factura.index');
  Route::match(['GET', 'HEAD'],'solicitar', 'RolCliente\Factura\FacturaController@create')->name('rolCliente.factura.create');
  Route::post('almacenar', 'RolCliente\Factura\FacturaController@store')->name('rolCliente.factura.store');
  Route::match(['GET', 'HEAD'],'detalles/{id_factura}', 'RolCliente\Factura\FacturaController@show')->name('rolCliente.factura.show');
  Route::match(['GET', 'HEAD'],'editar/{id_factura}', 'RolCliente\Factura\FacturaController@edit')->name('rolCliente.factura.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_factura}', 'RolCliente\Factura\FacturaController@update')->name('rolCliente.factura.update');
});