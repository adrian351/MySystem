<?php
Route::group(['prefix' => 'nota'], function() {
    Route::match(['GET', 'HEAD'],'', 'Almacen\Producto\NotaRemision\NotaRemisionController@index')->name('almacen.nota.index')->middleware('permission:almacen.nota.index|almacen.nota.edit|almacen.nota.show');

    Route::match(['GET', 'HEAD'],'generar-nota-remision/{id_nota}', 'Almacen\Producto\NotaRemision\NotaRemisionController@generar')->name('almacen.nota.generarNotaRemision')->middleware('permission:almacen.nota.descargar|almacen.nota.generar');

    Route::match(['GET', 'HEAD'],'detalles/{id_nota}', 'Almacen\Producto\NotaRemision\NotaRemisionController@show')->name('almacen.nota.show')->middleware('permission:almacen.nota.show');

    Route::match(['GET', 'HEAD'],'editar/{id_nota}', 'Almacen\Producto\NotaRemision\NotaRemisionController@edit')->name('almacen.nota.edit')->middleware('permission:almacen.nota.edit|almacen.nota.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_nota}', 'Almacen\Producto\NotaRemision\NotaRemisionController@update')->name('almacen.nota.update')->middleware('permission:almacen.nota.edit');
});
