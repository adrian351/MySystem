<?php
/* ===================== [ RUTAS PRODUCCIÓN (PEDIDO ACTIVO) ] ===================== */
Route::group(['prefix' => 'pedido-activo'], function() {
  Route::match(['GET', 'HEAD'],'{opc_consulta?}', 'Produccion\PedidoActivo\PedidoActivoController@index')->name('produccion.pedidoActivo.index')->middleware('permission:produccion.pedidoActivo.index|produccion.pedidoActivo.show|produccion.pedidoActivo.edit|produccion.pedidoActivo.armado.show|produccion.pedidoActivo.armado.edit');
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'Produccion\PedidoActivo\PedidoActivoController@show')->name('produccion.pedidoActivo.show')->middleware('permission:produccion.pedidoActivo.show|produccion.pedidoActivo.armado.show');
  Route::match(['GET', 'HEAD'],'editar/{id_pedido}', 'Produccion\PedidoActivo\PedidoActivoController@edit')->name('produccion.pedidoActivo.edit')->middleware('permission:produccion.pedidoActivo.edit|produccion.pedidoActivo.armado.show|produccion.pedidoActivo.armado.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_pedido}', 'Produccion\PedidoActivo\PedidoActivoController@update')->name('produccion.pedidoActivo.update')->middleware('permission:produccion.pedidoActivo.edit');
  Route::match(['GET', 'HEAD'],'orden-de-produccion/{id_pedido}', 'Produccion\PedidoActivo\PedidoActivoController@generarOrdenDeProduccion')->name('produccion.pedidoActivo.generarOrdenDeProduccion')->middleware('permission:produccion.pedidoActivo.index');

  Route::match(['PUT', 'PATCH'],'rack-armados/{id_pedido}', 'Produccion\PedidoActivo\PedidoActivoController@asignarRackArmados')->name('produccion.pedidoActivo.asignarRackArmados')->middleware('permission:produccion.pedidoActivo.edit');
 
  Route::group(['prefix' => 'armado'], function() {
    Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Produccion\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@show')->name('produccion.pedidoActivo.armado.show')->middleware('permission:produccion.pedidoActivo.armado.show|produccion.pedidoActivo.show');
    Route::match(['GET', 'HEAD'],'editar/{id_armado}', 'Produccion\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@edit')->name('produccion.pedidoActivo.armado.edit')->middleware('permission:produccion.pedidoActivo.armado.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_armado}', 'Produccion\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@update')->name('produccion.pedidoActivo.armado.update')->middleware('permission:produccion.pedidoActivo.armado.edit');
    Route::match(['PUT', 'PATCH'],'actualizar-modal/{id_armado}', 'Produccion\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@updateModal')->name('produccion.pedidoActivo.armado.updateModal')->middleware('permission:produccion.pedidoActivo.armado.edit');
 
    Route::group(['prefix' => 'direccion'], function() {
      Route::match(['GET', 'HEAD'],'detalles/{id_direccion}', 'Produccion\PedidoActivo\ArmadoPedidoActivo\Direccion\DireccionController@show')->name('produccion.pedidoActivo.armado.direccion.show')->middleware('permission:produccion.pedidoActivo.armado.show|produccion.pedidoActivo.show');
    });
  });
});

// Route::match(['GET', 'HEAD'],'notificacion/{opc_consulta?}', 'Produccion\PedidoActivo\PedidoActivoController@notifi')->name('produccion.pedido.notificacion.notifi')->middleware('permission:produccion.pedidoActivo.index|produccion.pedidoActivo.show|produccion.pedidoActivo.edit|produccion.pedidoActivo.armado.show|produccion.pedidoActivo.armado.edit');

Route::match(['GET', 'HEAD'],'reporte-produccion', 'Produccion\PedidoActivo\PedidoActivoController@reporteProduccionExport')->name('produccion.pedidoActivo.reporteProduccionExport')->middleware('permission:produccion.pedidoActivo.index');