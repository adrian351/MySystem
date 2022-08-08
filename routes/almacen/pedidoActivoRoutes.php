<?php
/* ===================== [ RUTAS ALMACÉN (PEDIDO ACTIVO) ] ===================== */
Route::group(['prefix' => 'pedido-activo'], function() {
  Route::match(['GET', 'HEAD'],'{opc_consulta?}', 'Almacen\PedidoActivo\PedidoActivoController@index')->name('almacen.pedidoActivo.index')->middleware('permission:almacen.pedidoActivo.index|almacen.pedidoActivo.show|almacen.pedidoActivo.edit|almacen.pedidoActivo.armado.show|almacen.pedidoActivo.armado.edit');
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'Almacen\PedidoActivo\PedidoActivoController@show')->name('almacen.pedidoActivo.show')->middleware('permission:almacen.pedidoActivo.show|almacen.pedidoActivo.armado.show');
  Route::match(['GET', 'HEAD'],'editar/{id_pedido}', 'Almacen\PedidoActivo\PedidoActivoController@edit')->name('almacen.pedidoActivo.edit')->middleware('permission:almacen.pedidoActivo.edit|almacen.pedidoActivo.armado.edit');
  Route::match(['POST'],'actualizar/{id_pedido}', 'Almacen\PedidoActivo\PedidoActivoController@update')->name('almacen.pedidoActivo.update')->middleware('permission:almacen.pedidoActivo.edit');
  Route::match(['GET', 'HEAD'],'orden-de-produccion-almacen/{id_pedido}', 'Almacen\PedidoActivo\PedidoActivoController@generarOrdenDeProduccion')->name('almacen.pedidoActivo.generarOrdenDeProduccion')->middleware('permission:almacen.pedidoActivo.index');
  Route::match(['PUT', 'PATCH'],'marcar-todo-completo/actualizar/{id_pedido}', 'Almacen\PedidoActivo\PedidoActivoController@marcarTodoCompleto')->name('almacen.pedidoActivo.marcarTodoCompleto.update')->middleware('permission:almacen.pedidoActivo.armado.edit');
  Route::match(['POST'],'generar-reporte', 'Almacen\PedidoActivo\PedidoActivoController@generarReporte')->name('almacen.pedidoActivo.generarReporte')->middleware('permission:almacen.pedidoActivo.index');

  Route::group(['prefix' => 'armado'], function() {
    Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Almacen\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@show')->name('almacen.pedidoActivo.armado.show')->middleware('permission:almacen.pedidoActivo.armado.show|almacen.pedidoActivo.show');
    Route::match(['GET', 'HEAD'],'editar/{id_armado}', 'Almacen\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@edit')->name('almacen.pedidoActivo.armado.edit')->middleware('permission:almacen.pedidoActivo.armado.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_armado}', 'Almacen\PedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@update')->name('almacen.pedidoActivo.armado.update')->middleware('permission:almacen.pedidoActivo.armado.edit');
  
    Route::group(['prefix' => 'sustituto'], function() {
      Route::match(['GET', 'HEAD'],'agregar/{id_producto}', 'Almacen\PedidoActivo\ArmadoPedidoActivo\SustitutoArmado\SustitutoArmadoController@create')->name('almacen.pedidoActivo.armado.sistituto.create')->middleware('permission:almacen.pedidoActivo.armado.edit');
      Route::post('crear/{ids}', 'Almacen\PedidoActivo\ArmadoPedidoActivo\SustitutoArmado\SustitutoArmadoController@store')->name('almacen.pedidoActivo.armado.sistituto.store')->middleware('permission:almacen.pedidoActivo.armado.edit');
      Route::match(['DELETE'],'eliminar/{id_sustituto}', 'Almacen\PedidoActivo\ArmadoPedidoActivo\SustitutoArmado\SustitutoArmadoController@destroy')->name('almacen.pedidoActivo.armado.sistituto.destroy')->middleware('permission:almacen.pedidoActivo.armado.edit');
    });
  });
});