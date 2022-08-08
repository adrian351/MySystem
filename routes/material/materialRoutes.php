<?php
/* ===================== [ RUTAS (MATERIALES) ] ===================== */
Route::group(['prefix' => 'material'], function() {
  Route::match(['GET', 'HEAD'],'', 'Material\MaterialController@index')->name('material.index')->middleware('permission:material.index|material.create|material.show|material.edit|material.destroy');
  Route::match(['GET', 'HEAD'],'crear', 'Material\MaterialController@create')->name('material.create')->middleware('permission:material.create');
  Route::post('almacenar', 'Material\MaterialController@store')->name('material.store')->middleware('permission:material.create');
  Route::match(['GET', 'HEAD'],'detalles/{id_material}', 'Material\MaterialController@show')->name('material.show')->middleware('permission:material.show');
  Route::match(['GET', 'HEAD'],'editar/{id_material}', 'Material\MaterialController@edit')->name('material.edit')->middleware('permission:material.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_material}', 'Material\MaterialController@update')->name('material.update')->middleware('permission:material.edit');
  Route::match(['DELETE'],'eliminar/{id_material}', 'Material\MaterialController@destroy')->name('material.destroy')->middleware('permission:material.destroy');
  Route::match(['GET', 'HEAD'],'consultar-precio', 'Material\MaterialController@consultarPrecio')->name('material.consultarPrecio')->middleware('permission:material.consultarPrecio');
  Route::post('importar', 'Material\MaterialController@importMaterial')->name('material.importMaterial')->middleware('permission:material.create');
});