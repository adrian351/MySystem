<?php
/* ===================== [ RUTAS SISTEMA (PLANTILLA) ] ===================== */
Route::group(['prefix' => 'plantilla'], function() {
  Route::match(['GET', 'HEAD'],'', 'Sistema\PlantillaController@index')->name('sistema.plantilla.index')->middleware('permission:sistema.plantilla.index|sistema.plantilla.create|sistema.plantilla.show|sistema.plantilla.edit|sistema.plantilla.destroy');
  Route::match(['GET', 'HEAD'],'crear', 'Sistema\PlantillaController@create')->name('sistema.plantilla.create')->middleware('permission:sistema.plantilla.create');
  Route::post('almacenar', 'Sistema\PlantillaController@store')->name('sistema.plantilla.store')->middleware('permission:sistema.plantilla.create');
  Route::match(['GET', 'HEAD'],'detalles/{id_plantilla}', 'Sistema\PlantillaController@show')->name('sistema.plantilla.show')->middleware('permission:sistema.plantilla.show');
  Route::match(['GET', 'HEAD'],'editar/{id_plantilla}', 'Sistema\PlantillaController@edit')->name('sistema.plantilla.edit')->middleware('permission:sistema.plantilla.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_plantilla}', 'Sistema\PlantillaController@update')->name('sistema.plantilla.update')->middleware('permission:sistema.plantilla.edit');
  Route::match(['DELETE'],'eliminar/{id_plantilla}', 'Sistema\PlantillaController@destroy')->name('sistema.plantilla.destroy')->middleware('permission:sistema.plantilla.destroy');
});