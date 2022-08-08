<?php
/* ===================== [ RUTAS (Inventario) ] ===================== */
Route::group(['prefix' => 'inventario'], function() {
  Route::match(['GET', 'HEAD'],'', 'TecnologiaDeLaInformacion\InventarioEquipoController@index')->name('inventario.index')->middleware('permission:inventario.index|inventario.edit|inventario.create|inventario.show|inventario.destroy|inventario.archivo.store|inventario.archivo.destroy|inventario.historial.store|inventario.historial.show');
  Route::match(['GET', 'HEAD'], 'crear', 'TecnologiaDeLaInformacion\InventarioEquipoController@create')->name('inventario.create')->middleware('permission:inventario.create');
  Route::post('almacenar', 'TecnologiaDeLaInformacion\InventarioEquipoController@store')->name('inventario.store')->middleware('permission:inventario.create');
  Route::match(['GET', 'HEAD'],'detalles/{id_inventario}', 'TecnologiaDeLaInformacion\InventarioEquipoController@show')->name('inventario.show')->middleware('permission:inventario.show');
  Route::match(['GET', 'HEAD'],'editar/{id_inventario}', 'TecnologiaDeLaInformacion\InventarioEquipoController@edit')->name('inventario.edit')->middleware('permission:inventario.edit');
  Route::match([' PUT', 'PATCH'], 'actualizar/{id_inventario}', 'TecnologiaDeLaInformacion\InventarioEquipoController@update')->name('inventario.update')->middleware('permission:inventario.edit');
  Route::match(['DELETE'],'eliminar/{id_inventario}', 'TecnologiaDeLaInformacion\InventarioEquipoController@destroy')->name('inventario.destroy')->middleware('permission:inventario.destroy');
  Route::match(['GET', 'HEAD'],'generar-reporte', 'TecnologiaDeLaInformacion\InventarioEquipoController@generarReporte')->name('inventario.generarReporte')->middleware('permission:inventario.index');

  Route::group(['prefix' => 'archivo'], function() {
    Route::post('almacenar/{id_inventario}', 'TecnologiaDeLaInformacion\ArchivosInventario\ArchivoInventarioController@store')->name('inventario.archivo.store')->middleware('permission:inventario.edit|inventario.archivo.store');
    Route::match(['DELETE'], 'eliminar/{id_archivo}', 'TecnologiaDeLaInformacion\ArchivosInventario\ArchivoInventarioController@destroy')->name('inventario.archivo.destroy')->middleware('permission:inventario.edit|inventario.archivo.destroy');
  });

  Route::group(['prefix' => 'historial'], function() {
    Route::match('almacenar/{id_inventario}', 'TecnologiaDeLaInformacion\HistorialController@store')->name('inventario.historial.store')->middleware('permission:inventario.historial.store');
    Route::match(['GET', 'HEAD'], 'detalles/{id_historial}', 'TecnologiaDeLaInformacion\HistorialController@show')->name('inventario.historial.show')->middleware('permission:inventario.show|inventario.historial.show');
  });
});