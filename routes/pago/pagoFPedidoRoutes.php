<?php
/* ===================== [ RUTAS PAGOS (FILTRADO POR PEDIDO) ] ===================== */
Route::group(['prefix' => 'f-pedido'], function() {
  Route::match(['GET', 'HEAD'],'', 'Pago\fPedido\PagoPedidoController@index')->name('pago.fPedido.index')->middleware('permission:pago.fPedido.index|pago.fPedido.create|pago.fPedido.show|pago.fPedido.edit|venta.pedidoActivo.show|venta.pedidoActivo.pago.create|venta.pedidoActivo.pago.show|venta.pedidoActivo.pago.edit');
  Route::match(['GET', 'HEAD'],'registrar/{id_pedido}', 'Pago\fPedido\PagoPedidoController@create')->name('pago.fPedido.create')->middleware('permission:pago.fPedido.index|pago.fPedido.create|pago.fPedido.show|pago.fPedido.edit|venta.pedidoActivo.show|venta.pedidoActivo.pago.create|venta.pedidoActivo.pago.show|venta.pedidoActivo.pago.edit');
  Route::post('almacenar/{id_pedido}', 'Pago\Individual\PagoController@store')->name('pago.fPedido.store')->middleware('permission:pago.fPedido.create|venta.pedidoActivo.pago.create');
  Route::match(['GET', 'HEAD'],'generar-codigo/{id_pedido}', 'Pago\fPedido\PagoPedidoController@generarCodigo')->name('pago.fPedido.generarCodigo')->middleware('permission:pago.fPedido.index|pago.fPedido.create|pago.fPedido.show|pago.fPedido.edit|venta.pedidoActivo.show|venta.pedidoActivo.pago.create|venta.pedidoActivo.pago.show|venta.pedidoActivo.pago.edit');
  Route::post('almacenar-codigo/{id_pedido}', 'Pago\Individual\PagoController@storeCodigo')->name('pago.fPedido.storeCodigo')->middleware('permission:pago.fPedido.create|venta.pedidoActivo.pago.create');
  Route::match(['GET', 'HEAD'],'detalles/d/{id_pago}', 'Pago\fPedido\PagoPedidoController@show')->name('pago.fPedido.show')->middleware('permission:pago.fPedido.show|venta.pedidoActivo.show|venta.pedidoActivo.pago.show');
  Route::match(['GET', 'HEAD'],'editar/{id_pago}', 'Pago\fPedido\PagoPedidoController@edit')->name('pago.fPedido.edit')->middleware('permission:pago.fPedido.edit|venta.pedidoActivo.pago.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_pago}', 'Pago\fPedido\PagoPedidoController@update')->name('pago.fPedido.update')->middleware('permission:pago.fPedido.edit|venta.pedidoActivo.pago.edit');
  Route::match(['GET', 'HEAD'],'generar-reporte', 'Pago\fPedido\PagoPedidoController@generarReporte')->name('pago.fPedido.generarReporte')->middleware('permission:pago.fPedido.index');
});