<?php
/* ===================== [ RUTAS SISTEMA (SERIES) ] ===================== */
Route::group(['prefix' => 'serie'], function() {
  Route::match(['GET', 'HEAD'],'', 'Sistema\SerieController@index')->name('sistema.serie.index')->middleware('permission:sistema.serie.index|sistema.serie.create|sistema.serie.show|sistema.serie.edit|sistema.serie.destroy');
  Route::match(['GET', 'HEAD'],'crear', 'Sistema\SerieController@create')->name('sistema.serie.create')->middleware('permission:sistema.serie.create');
  Route::post('almacenar', 'Sistema\SerieController@store')->name('sistema.serie.store')->middleware('permission:sistema.serie.create');
  Route::match(['GET', 'HEAD'],'detalles/{id_serie}', 'Sistema\SerieController@show')->name('sistema.serie.show')->middleware('permission:sistema.serie.show');
  Route::match(['GET', 'HEAD'],'editar/{id_serie}', 'Sistema\SerieController@edit')->name('sistema.serie.edit')->middleware('permission:sistema.serie.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_serie}', 'Sistema\SerieController@update')->name('sistema.serie.update')->middleware('permission:sistema.serie.edit');
  Route::match(['DELETE'],'eliminar/{id_serie}', 'Sistema\SerieController@destroy')->name('sistema.serie.destroy')->middleware('permission:sistema.serie.destroy');
});