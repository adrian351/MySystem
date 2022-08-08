<?php
/* ===================== [ RUTAS PRODUCCIÓN (PEDIDOS TERMINADOS) ] ===================== */
Route::group(['prefix' => 'pedido-terminado'], function() {
  Route::match(['GET', 'HEAD'],'', 'Produccion\PedidoTerminado\PedidoTerminadoController@index')->name('produccion.pedidoTerminado.index')->middleware('permission:produccion.pedidoTerminado.index|produccion.pedidoTerminado.show');;
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'Produccion\PedidoTerminado\PedidoTerminadoController@show')->name('produccion.pedidoTerminado.show')->middleware('permission:produccion.pedidoTerminado.show');

  Route::group(['prefix' => 'armado'], function() {
    Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Produccion\PedidoTerminado\ArmadoPedidoTerminado\ArmadoPedidoTerminadoController@show')->name('produccion.pedidoTerminado.armado.show')->middleware('permission:produccion.pedidoTerminado.show');
  });
});