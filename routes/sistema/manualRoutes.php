<?php
/* ===================== [ RUTAS SISTEMA (CATÁLOGO) ] ===================== */
Route::group(['prefix' => 'manual'], function() {
  Route::match(['GET', 'HEAD'],'', 'Sistema\ManualController@index')->name('manual.index')->middleware('permission:manual.index|manual.create|manual.show|manual.edit|manual.destroy');
  Route::match(['GET', 'HEAD'],'cargar', 'Sistema\ManualController@create')->name('manual.create')->middleware('permission:manual.create');
  Route::post('almacenar', 'Sistema\ManualController@store')->name('manual.store')->middleware('permission:manual.create');
  Route::match(['GET', 'HEAD'],'detalles/{id_manual}', 'Sistema\ManualController@show')->name('manual.show')->middleware('permission:manual.show');
  Route::match(['GET', 'HEAD'],'editar/{id_manual}', 'Sistema\ManualController@edit')->name('manual.edit')->middleware('permission:manual.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_manual}', 'Sistema\ManualController@update')->name('manual.update')->middleware('permission:manual.edit');
  Route::match(['DELETE'],'eliminar/{id_manual}', 'Sistema\ManualController@destroy')->name('manual.destroy')->middleware('permission:manual.destroy');
});