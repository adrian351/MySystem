<?php
Route::group(['prefix' => 'categoria'], function() {
    Route::match(['GET', 'HEAD'],'', 'Categoria\CategoriaController@index')->name('categoria.index')
    ->middleware('permission:categoria.index|categoria.create|categoria.edit|categoria.destroy');
    Route::match(['GET', 'HEAD'],'crear', 'Categoria\CategoriaController@create')->name('categoria.create')
    ->middleware('permission:categoria.create');
    Route::post('almacenar', 'Categoria\CategoriaController@store')->name('categoria.store')
    ->middleware('permission:categoria.create');
    Route::match(['GET', 'HEAD'],'editar/{id_categoria}', 'Categoria\CategoriaController@edit')->name('categoria.edit')
    ->middleware('permission:categoria.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_categoria}', 'Categoria\CategoriaController@update')->name('categoria.update')
    ->middleware('permission:categoria.edit');
    Route::match(['DELETE'],'eliminar/{id_categoria}', 'Categoria\CategoriaController@destroy')->name('categoria.destroy')
    ->middleware('permission:categoria.destroy');
});
