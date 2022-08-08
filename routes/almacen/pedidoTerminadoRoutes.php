<?php
/* ===================== [ RUTAS ALMACÉN (PEDIDOS TERMINADOS) ] ===================== */
Route::group(['prefix' => 'pedido-terminado'], function() {
  Route::match(['GET', 'HEAD'],'', 'Almacen\PedidoTerminado\PedidoTerminadoController@index')->name('almacen.pedidoTerminado.index')->middleware('permission:almacen.pedidoTerminado.index|almacen.pedidoTerminado.show');;
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'Almacen\PedidoTerminado\PedidoTerminadoController@show')->name('almacen.pedidoTerminado.show')->middleware('permission:almacen.pedidoTerminado.show');

  Route::group(['prefix' => 'armado'], function() {
    Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Almacen\PedidoTerminado\ArmadoPedidoTerminado\ArmadoPedidoTerminadoController@show')->name('almacen.pedidoTerminado.armado.show')->middleware('permission:almacen.pedidoTerminado.show');
  });
});