<?php
/* ===================== [ RUTAS (SOPORTE) ] ===================== */
Route::group(['prefix' => 'soporte'], function() {
  Route::match(['GET', 'HEAD'],'', 'TecnologiaDeLaInformacion\SoporteController@index')->name('soporte.index')->middleware('permission:soporte.index|soporte.show|soporte.edit|soporte.update|soporte.destroy');
  Route::match(['GET', 'HEAD'],'detalles/{id_soporte}', 'TecnologiaDeLaInformacion\SoporteController@show')->name('soporte.show')->middleware('permission:soporte.show');
  Route::match(['GET', 'HEAD'],'editar/{id_soporte}', 'TecnologiaDeLaInformacion\SoporteController@edit')->name('soporte.edit')->middleware('permission:soporte.edit');
  Route::match(['PUT', 'PATCH'], 'actualizar/{id_soporte}', 'TecnologiaDeLaInformacion\SoporteController@update')->name('soporte.update')->middleware('permission:soporte.edit');
  Route::match(['DELETE'],'eliminar/{id_soporte}','TecnologiaDeLaInformacion\SoporteController@destroy')->name('soporte.destroy')->middleware('permission:soporte.destroy');
});