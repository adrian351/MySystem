<?php
/* ===================== [ RUTAS (STOCK) ] ===================== */
Route::group(['prefix' => 'stock'], function() {
  Route::match(['GET', 'HEAD'],'', 'Stock\StockController@index')->name('stock.index')->middleware('permission:stock.index|stock.create|stock.show|stock.edit|stock.destroy');
  Route::match(['GET', 'HEAD'],'crear', 'Stock\StockController@create')->name('stock.create')->middleware('permission:stock.create');
  Route::post('almacenar', 'Stock\StockController@store')->name('stock.store')->middleware('permission:stock.create');
  Route::match(['GET', 'HEAD'],'detalles/{id_stock}', 'Stock\StockController@show')->name('stock.show')->middleware('permission:stock.show');
  Route::match(['GET', 'HEAD'],'editar/{id_stock}', 'Stock\StockController@edit')->name('stock.edit')->middleware('permission:stock.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_stock}', 'Stock\StockController@update')->name('stock.update')->middleware('permission:stock.edit');
  Route::match(['DELETE'],'eliminar/{id_stock}', 'Stock\StockController@destroy')->name('stock.destroy')->middleware('permission:stock.destroy');
});