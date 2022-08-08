<?php
Route::group(['prefix' => 'etiqueta'], function() {
    Route::match(['GET', 'HEAD'],'', 'Etiqueta\EtiquetaController@index')->name('etiqueta.index')
    ->middleware('permission:etiqueta.index|etiqueta.create|etiqueta.edit|etiqueta.destroy');
    Route::match(['GET', 'HEAD'],'crear', 'Etiqueta\EtiquetaController@create')->name('etiqueta.create')
    ->middleware('permission:etiqueta.create');
    Route::post('almacenar', 'Etiqueta\EtiquetaController@store')->name('etiqueta.store')
    ->middleware('permission:etiqueta.create');
    Route::match(['GET', 'HEAD'],'detalles/{id_etiqueta}', 'Etiqueta\EtiquetaController@show')->name('etiqueta.show')->middleware('permission:etiqueta.show');
    Route::match(['GET', 'HEAD'],'editar/{id_etiqueta}', 'Etiqueta\EtiquetaController@edit')->name('etiqueta.edit')
    ->middleware('permission:etiqueta.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_etiqueta}', 'Etiqueta\EtiquetaController@update')->name('etiqueta.update')
    ->middleware('permission:etiqueta.edit');
    Route::match(['DELETE'],'eliminar/{id_etiqueta}', 'Etiqueta\EtiquetaController@destroy')->name('etiqueta.destroy')
    ->middleware('permission:etiqueta.destroy');
});