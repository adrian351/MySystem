<?php
Route::group(['prefix' => 'subCategoria'], function() {
    Route::match(['GET', 'HEAD'],'', 'subCategoria\SubCategoriaController@index')->name('subCategoria.index')
    ->middleware('permission:subCategoria.index|subCategoria.create|subCategoria.edit|subCategoria.destroy');
    Route::match(['GET', 'HEAD'],'crear', 'subCategoria\SubCategoriaController@create')->name('subCategoria.create')
    ->middleware('permission:subCategoria.create');
    Route::post('almacenar', 'subCategoria\SubCategoriaController@store')->name('subCategoria.store')
    ->middleware('permission:subCategoria.create');
    Route::match(['GET', 'HEAD'],'editar/{id_subCategoria}', 'subCategoria\SubCategoriaController@edit')->name('subCategoria.edit')
    ->middleware('permission:subCategoria.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_subCategoria}', 'subCategoria\SubCategoriaController@update')->name('subCategoria.update')
    ->middleware('permission:subCategoria.edit');
    Route::match(['DELETE'],'eliminar/{id_subCategoria}', 'subCategoria\SubCategoriaController@destroy')->name('subCategoria.destroy')
    ->middleware('permission:subCategoria.destroy');
});