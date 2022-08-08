<?php
Route::group(['prefix' => 'marca'], function() {
    Route::match(['GET', 'HEAD'],'', 'Marca\MarcaController@index')->name('marca.index')
    ->middleware('permission:marca.index|marca.create|marca.edit|marca.destroy');
    Route::match(['GET', 'HEAD'],'crear', 'Marca\MarcaController@create')->name('marca.create')
    ->middleware('permission:marca.create');
    Route::post('almacenar', 'Marca\MarcaController@store')->name('marca.store')
    ->middleware('permission:marca.create');
    Route::match(['GET', 'HEAD'],'editar/{id_marca}', 'Marca\MarcaController@edit')->name('marca.edit')
    ->middleware('permission:marca.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_marca}', 'Marca\MarcaController@update')->name('marca.update')
    ->middleware('permission:marca.edit');
    Route::match(['DELETE'],'eliminar/{id_marca}', 'Marca\MarcaController@destroy')->name('marca.destroy')
    ->middleware('permission:marca.destroy');
    Route::get('/{marca_id}', 'Marca\MarcaController@byMarcas')->middleware('permission:cotizacion.edit');
});