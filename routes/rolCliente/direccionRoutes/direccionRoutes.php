<?php
/* ===================== [ RUTAS (DIRECCIONES DE ENTREGA) ] ===================== */
Route::group(['prefix' => 'direccion-de-entrega'], function() {
  Route::match(['GET', 'HEAD'],'', 'RolCliente\Direccion\DireccionController@index')->name('rolCliente.direccion.index');
  Route::match(['GET', 'HEAD'],'crear', 'RolCliente\Direccion\DireccionController@create')->name('rolCliente.direccion.create');
  Route::post('almacenar', 'RolCliente\Direccion\DireccionController@store')->name('rolCliente.direccion.store');
  Route::match(['GET', 'HEAD'],'detalles/{id_direccion}', 'RolCliente\Direccion\DireccionController@show')->name('rolCliente.direccion.show');
  Route::match(['GET', 'HEAD'],'editar/{id_direccion}', 'RolCliente\Direccion\DireccionController@edit')->name('rolCliente.direccion.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_direccion}', 'RolCliente\Direccion\DireccionController@update')->name('rolCliente.direccion.update');
  Route::match(['DELETE'],'eliminar/{id_direccion}', 'RolCliente\Direccion\DireccionController@destroy')->name('rolCliente.direccion.destroy');
  Route::match(['GET', 'HEAD'],'obtener/{id_direccion}', 'RolCliente\Direccion\DireccionController@getDireccionFind');
});