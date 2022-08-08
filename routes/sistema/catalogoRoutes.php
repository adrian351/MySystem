<?php
/* ===================== [ RUTAS SISTEMA (CATÁLOGO) ] ===================== */
Route::group(['prefix' => 'catalogo'], function() {
  Route::match(['GET', 'HEAD'],'', 'Sistema\CatalogoController@index')->name('sistema.catalogo.index')->middleware('permission:sistema.catalogo.index|sistema.catalogo.create|sistema.catalogo.show|sistema.catalogo.edit|sistema.catalogo.destroy');
  Route::match(['GET', 'HEAD'],'crear', 'Sistema\CatalogoController@create')->name('sistema.catalogo.create')->middleware('permission:sistema.catalogo.create');
  Route::post('almacenar', 'Sistema\CatalogoController@store')->name('sistema.catalogo.store')->middleware('permission:sistema.catalogo.create');
  Route::match(['GET', 'HEAD'],'detalles/{id_catalogo}', 'Sistema\CatalogoController@show')->name('sistema.catalogo.show')->middleware('permission:sistema.catalogo.show');
  Route::match(['GET', 'HEAD'],'editar/{id_catalogo}', 'Sistema\CatalogoController@edit')->name('sistema.catalogo.edit')->middleware('permission:sistema.catalogo.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_catalogo}', 'Sistema\CatalogoController@update')->name('sistema.catalogo.update')->middleware('permission:sistema.catalogo.edit');
  Route::match(['DELETE'],'eliminar/{id_catalogo}', 'Sistema\CatalogoController@destroy')->name('sistema.catalogo.destroy')->middleware('permission:sistema.catalogo.destroy');
});