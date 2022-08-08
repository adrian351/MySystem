<?php
/* ===================== [ RUTAS (RUTAS) ] ===================== */
Route::group(['prefix' => 'ruta'], function() {
  Route::match(['GET', 'HEAD'],'', 'RolFerro\Ruta\RutaController@index')->name('rolFerro.ruta.index');
  Route::match(['GET', 'HEAD'],'crear', 'RolFerro\Ruta\RutaController@create')->name('rolFerro.ruta.create');
  Route::post('almacenar', 'RolFerro\Ruta\RutaController@store')->name('rolFerro.ruta.store');
  Route::match(['GET', 'HEAD'],'detalles/{id_ruta}', 'RolFerro\Ruta\RutaController@show')->name('rolFerro.ruta.show');
  Route::match(['GET', 'HEAD'],'editar/{id_ruta}', 'RolFerro\Ruta\RutaController@edit')->name('rolFerro.ruta.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_ruta}', 'RolFerro\Ruta\RutaController@update')->name('rolFerro.ruta.update');
  Route::match(['DELETE'],'eliminar/{id_ruta}', 'RolFerro\Ruta\RutaController@destroy')->name('rolFerro.ruta.destroy');
});