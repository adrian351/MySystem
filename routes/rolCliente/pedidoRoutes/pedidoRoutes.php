<?php
/* ===================== [ RUTAS (PEDIDOS) ] ===================== */
Route::group(['prefix' => 'pedido'], function() {
  Route::match(['GET', 'HEAD'],'', 'RolCliente\Pedido\PedidoController@index')->name('rolCliente.pedido.index');
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'RolCliente\Pedido\PedidoController@show')->name('rolCliente.pedido.show');
  Route::match(['GET', 'HEAD'],'editar/{id_pedido}', 'RolCliente\Pedido\PedidoController@edit')->name('rolCliente.pedido.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_pedido}', 'RolCliente\Pedido\PedidoController@update')->name('rolCliente.pedido.update');
  Route::match(['GET', 'HEAD'],'faltante-de-pago/{id_pedido}', 'RolCliente\Pedido\PedidoController@getFaltanteDePago')->name('rolCliente.pedido.getFaltanteDePago');

  Route::group(['prefix' => 'armado'], function() {
    Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'RolCliente\Pedido\Armado\ArmadoController@show')->name('rolCliente.pedido.armado.show');

    Route::group(['prefix' => 'direccion'], function() {
      Route::match(['GET', 'HEAD'],'editar/{id_direccion}', 'RolCliente\Pedido\Armado\Direccion\DireccionController@edit')->name('rolCliente.pedido.armado.direccion.edit');
      Route::match(['PUT', 'PATCH'],'actualizar/{id_pedido}', 'RolCliente\Pedido\Armado\Direccion\DireccionController@update')->name('rolCliente.pedido.armado.direccion.update');
      Route::match(['GET', 'HEAD'],'detalles/{id_direccion}', 'RolCliente\Pedido\Armado\Direccion\DireccionController@show')->name('rolCliente.pedido.armado.direccion.show');
    });
  });
});