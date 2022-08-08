<?php
/* ===================== [ RUTAS (DADOS FISALES) ] ===================== */
Route::group(['prefix' => 'dato-fiscal'], function() {
  Route::match(['GET', 'HEAD'],'', 'RolCliente\DatoFiscal\DatoFiscalController@index')->name('rolCliente.datoFiscal.index');
  Route::match(['GET', 'HEAD'],'crear', 'RolCliente\DatoFiscal\DatoFiscalController@create')->name('rolCliente.datoFiscal.create');
  Route::post('almacenar', 'RolCliente\DatoFiscal\DatoFiscalController@store')->name('rolCliente.datoFiscal.store');
  Route::match(['GET', 'HEAD'],'detalles/{id_dato_fiscal}', 'RolCliente\DatoFiscal\DatoFiscalController@show')->name('rolCliente.datoFiscal.show');
  Route::match(['GET', 'HEAD'],'editar/{id_dato_fiscal}', 'RolCliente\DatoFiscal\DatoFiscalController@edit')->name('rolCliente.datoFiscal.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_dato_fiscal}', 'RolCliente\DatoFiscal\DatoFiscalController@update')->name('rolCliente.datoFiscal.update');
  Route::match(['DELETE'],'eliminar/{id_dato_fiscal}', 'RolCliente\DatoFiscal\DatoFiscalController@destroy')->name('rolCliente.datoFiscal.destroy');
});