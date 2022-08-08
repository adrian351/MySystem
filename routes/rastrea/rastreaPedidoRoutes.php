<?php
/* ===================== [ RUTAS RASTREAR (RASTREAR PEDIDO) ] ===================== */
Route::group(['prefix' => 'pedido'], function() {
  Route::match(['GET', 'HEAD'],'', 'Rastrea\RastreaPedidoController@index')->name('rastrea.pedido.index')->middleware('permission:rastrea.pedido.show|rastrea.pedido.showFull');
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'Rastrea\RastreaPedidoController@show')->name('rastrea.pedido.show')->middleware('permission:rastrea.pedido.show|rastrea.pedido.showFull');
  Route::match(['GET', 'HEAD'],'QR/{id}/{modulo}/{otro?}', 'Rastrea\RastreaPedidoController@rastrearPorQR')->name('rastrea.pedido.rastrearPorQR');

  Route::group(['prefix' => 'armado'], function() {
    Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Rastrea\RastreaArmadoController@show')->name('rastrea.pedido.armado.show')->middleware('permission:rastrea.pedido.show|rastrea.pedido.showFull');
  });
});