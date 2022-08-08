<?php
/* ===================== [ RUTAS LOGÍSTICA (PEDIDOS ENTREGADOS) ] ===================== */
Route::group(['prefix' => 'pedido-entregado'], function() {
  Route::match(['GET', 'HEAD'],'', 'Logistica\PedidoEntregado\PedidoEntregadoController@index')->name('logistica.pedidoEntregado.index')->middleware('permission:logistica.pedidoEntregado.index|logistica.pedidoEntregado.show');;
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'Logistica\PedidoEntregado\PedidoEntregadoController@show')->name('logistica.pedidoEntregado.show')->middleware('permission:logistica.pedidoEntregado.show');

  Route::group(['prefix' => 'armado'], function() {
    Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Logistica\PedidoEntregado\ArmadoPedidoEntregado\ArmadoPedidoEntregadoController@show')->name('logistica.pedidoEntregado.armado.show')->middleware('permission:logistica.pedidoEntregado.show');
  });
});