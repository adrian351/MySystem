<?php
/* ===================== [ RUTAS VENTAS (PEDIDOS TERMINADOS) ] ===================== */
Route::group(['prefix' => 'pedido-terminado'], function() {
  Route::match(['GET', 'HEAD'],'{opc_consulta?}', 'Venta\PedidoTerminado\PedidoTerminadoController@index')->name('venta.pedidoTerminado.index')->middleware('permission:venta.pedidoTerminado.index|venta.pedidoTerminado.show');;
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'Venta\PedidoTerminado\PedidoTerminadoController@show')->name('venta.pedidoTerminado.show')->middleware('permission:venta.pedidoTerminado.show');
  Route::match(['DELETE'],'eliminar/{id_pedido}', 'Venta\PedidoTerminado\PedidoTerminadoController@destroy')->name('venta.pedidoTerminado.destroy')->middleware('permission:venta.pedidoTerminado.destroy');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_pedido}', 'Venta\PedidoTerminado\PedidoTerminadoController@update')->name('venta.pedidoTerminado.update')->middleware('permission:venta.pedidoTerminado.show');
 
  Route::group(['prefix' => 'armado'], function() {
    Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Venta\PedidoTerminado\ArmadoPedidoTerminado\ArmadoPedidoTerminadoController@show')->name('venta.pedidoTerminado.armado.show')->middleware('permission:venta.pedidoTerminado.show');
 
    Route::group(['prefix' => 'direccion'], function() {
      Route::match(['GET', 'HEAD'],'detalles/{id_direccion}', 'Venta\PedidoTerminado\ArmadoPedidoTerminado\Direccion\DireccionController@show')->name('venta.pedidoTerminado.armado.direccion.show')->middleware('permission:venta.pedidoTerminado.armado.show|venta.pedidoTerminado.show');
    });
  });
});