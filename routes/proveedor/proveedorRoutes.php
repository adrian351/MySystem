<?php
/* ===================== [ RUTAS (PROVEEDOR) ] ===================== */
Route::group(['prefix' => 'proveedor'], function() {
  Route::match(['GET', 'HEAD'],'', 'Proveedor\ProveedorController@index')->name('proveedor.index')->middleware('permission:proveedor.index|proveedor.create|proveedor.show|proveedor.edit|proveedor.destroy|proveedor.editValidado|proveedor.contacto.index|proveedor.contacto.create|proveedor.contacto.show|proveedor.contacto.edit|proveedor.contacto.destroy');
  Route::match(['GET', 'HEAD'],'crear', 'Proveedor\ProveedorController@create')->name('proveedor.create')->middleware('permission:proveedor.create');
  Route::post('almacenar', 'Proveedor\ProveedorController@store')->name('proveedor.store')->middleware('permission:proveedor.create');
  Route::match(['GET', 'HEAD'],'detalles/{id_proveedor}', 'Proveedor\ProveedorController@show')->name('proveedor.show')->middleware('permission:proveedor.show|proveedor.contacto.show');
  Route::match(['GET', 'HEAD'],'editar/{id_proveedor}', 'Proveedor\ProveedorController@edit')->name('proveedor.edit')->middleware('permission:proveedor.edit|proveedor.editValidado|proveedor.contacto.index|proveedor.contacto.create|proveedor.contacto.edit|proveedor.contacto.destroy');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_proveedor}', 'Proveedor\ProveedorController@update')->name('proveedor.update')->middleware('permission:proveedor.edit');
  Route::match(['PUT', 'PATCH'],'actualizar-validado/{id_proveedor}', 'Proveedor\ProveedorController@updateValidado')->name('proveedor.updateValidado')->middleware('permission:proveedor.editValidado');
  Route::match(['DELETE'],'eliminar/{id_proveedor}', 'Proveedor\ProveedorController@destroy')->name('proveedor.destroy')->middleware('permission:proveedor.destroy');

  Route::group(['prefix' => 'contacto'], function() {
    Route::match(['GET', 'HEAD'],'crear/{id_proveedor}', 'Proveedor\ContactoProveedor\ContactoController@create')->name('proveedor.contacto.create')->middleware('permission:proveedor.contacto.create');
    Route::post('almacenar/{id_proveedor}', 'Proveedor\ContactoProveedor\ContactoController@store')->name('proveedor.contacto.store')->middleware('permission:proveedor.contacto.create');
    Route::match(['GET', 'HEAD'],'detalles/{id_contacto}', 'Proveedor\ContactoProveedor\ContactoController@show')->name('proveedor.contacto.show')->middleware('permission:proveedor.show|proveedor.contacto.show');
    Route::match(['GET', 'HEAD'],'editar/{id_contacto}', 'Proveedor\ContactoProveedor\ContactoController@edit')->name('proveedor.contacto.edit')->middleware('permission:proveedor.contacto.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_contacto}', 'Proveedor\ContactoProveedor\ContactoController@update')->name('proveedor.contacto.update')->middleware('permission:proveedor.contacto.edit');
    Route::match(['DELETE'],'eliminar/{id_contacto}', 'Proveedor\ContactoProveedor\ContactoController@destroy')->name('proveedor.contacto.destroy')->middleware('permission:proveedor.contacto.destroy');
  });
});