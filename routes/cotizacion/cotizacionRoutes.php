<?php
/* ===================== [ RUTAS (COTIZACION) ] ===================== */
Route::group(['prefix' => 'cotizacion'], function() {
    Route::match(['GET', 'HEAD'],'', 'Cotizacion\CotizacionController@index')->name('cotizacion.index')->middleware('permission:cotizacion.index|cotizacion.create|cotizacion.show|cotizacion.edit|cotizacion.destroy');
    Route::match(['GET', 'HEAD'],'crear', 'Cotizacion\CotizacionController@create')->name('cotizacion.create')->middleware('permission:cotizacion.create');
    Route::post('almacenar', 'Cotizacion\CotizacionController@store')->name('cotizacion.store')->middleware('permission:cotizacion.create');

    Route::match(['GET', 'HEAD'],'detalles/{id_cotizacion}', 'Cotizacion\CotizacionController@show')->name('cotizacion.show')->middleware('permission:cotizacion.show');
    // editamos una coptizacion
    Route::match(['GET', 'HEAD'],'editar/{id_cotizacion}', 'Cotizacion\CotizacionController@edit')->name('cotizacion.edit')->middleware('permission:cotizacion.edit');

    Route::match(['PUT', 'PATCH'],'actualizar/{id_cotizacion}', 'Cotizacion\CotizacionController@update')->name('cotizacion.update')->middleware('permission:cotizacion.edit');
    Route::match(['DELETE'],'eliminar/{id_cotizacion}', 'Cotizacion\CotizacionController@destroy')->name('cotizacion.destroy')->middleware('permission:cotizacion.destroy');
    Route::match(['GET', 'HEAD'],'detalles-por-numPedido/{num_pedido}', 'Cotizacion\CotizacionController@showPorNumPedido')->name('cotizacion.showPorNumPedido')->middleware('permission:cotizacion.show');

    Route::match(['PUT', 'PATCH'],'actualizar-iva/{id_cotizacion}', 'Cotizacion\CotizacionController@updateIva')->name('cotizacion.updateIva')->middleware('permission:cotizacion.edit');
    Route::match(['PUT', 'PATCH'],'actualizar-comision/{id_cotizacion}', 'Cotizacion\CotizacionController@updateComision')->name('cotizacion.updateComision')->middleware('permission:cotizacion.edit');
    Route::match(['GET', 'HEAD'],'generar-cotizacion/{id_cotizacion}', 'Cotizacion\CotizacionController@generar')->name('cotizacion.generarCotizacion')->middleware('permission:cotizacion.index|cotizacion.show|cotizacion.edit');
    Route::match(['GET', 'HEAD'],'clonar-cotizacion/{id_cotizacion}', 'Cotizacion\CotizacionController@clonar')->name('cotizacion.clonar')->middleware('permission:cotizacion.edit');
    Route::match(['GET', 'HEAD'],'aprobar-cotizacion/{id_cotizacion}', 'Cotizacion\CotizacionController@aprobar')->name('cotizacion.aprobar')->middleware('permission:cotizacion.edit');
    Route::match(['GET', 'HEAD'],'cancelar-cotizacion/{id_cotizacion}', 'Cotizacion\CotizacionController@cancelar')->name('cotizacion.cancelar')->middleware('permission:cotizacion.edit');
    Route::group(['prefix' => 'armado'], function() {
        Route::post('almacenar/{id_cotizacion}', 'Cotizacion\ArmadoCotizacion\ArmadoCotizacionController@store')->name('cotizacion.armado.store')->middleware('permission:cotizacion.edit');
        Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Cotizacion\ArmadoCotizacion\ArmadoCotizacionController@show')->name('cotizacion.armado.show')->middleware('permission:cotizacion.show');
        Route::match(['GET', 'HEAD'],'editar/{id_armado}', 'Cotizacion\ArmadoCotizacion\ArmadoCotizacionController@edit')->name('cotizacion.armado.edit')->middleware('permission:cotizacion.edit');
        Route::match(['PUT', 'PATCH'],'actualizar/{id_armado}', 'Cotizacion\ArmadoCotizacion\ArmadoCotizacionController@update')->name('cotizacion.armado.update')->middleware('permission:cotizacion.edit');
        Route::match(['DELETE'],'eliminar/{id_armado}', 'Cotizacion\ArmadoCotizacion\ArmadoCotizacionController@destroy')->name('cotizacion.armado.destroy')->middleware('permission:cotizacion.edit');
    
        Route::match(['GET', 'HEAD'],'clonar/{id_armado}', 'Cotizacion\ArmadoCotizacion\ArmadoCotizacionController@clonar')->name('cotizacion.armado.clonar')->middleware('permission:cotizacion.edit');

        Route::group(['prefix' => 'direccion'], function() {
            Route::match(['GET', 'HEAD'],'crear/{id_armado}', 'Cotizacion\ArmadoCotizacion\DireccionArmado\DireccionArmadoController@create')->name('cotizacion.armado.direccion.create')->middleware('permission:cotizacion.edit');
            Route::post('almacenar/{id_armado}', 'Cotizacion\ArmadoCotizacion\DireccionArmado\DireccionArmadoController@store')->name('cotizacion.armado.direccion.store')->middleware('permission:cotizacion.edit');
            Route::match(['GET', 'HEAD'],'editar/{id_direccion}', 'Cotizacion\ArmadoCotizacion\DireccionArmado\DireccionArmadoController@edit')->name('cotizacion.armado.direccion.edit')->middleware('permission:cotizacion.edit');
            Route::match(['PUT', 'PATCH'],'actualizar/{id_direccion}', 'Cotizacion\ArmadoCotizacion\DireccionArmado\DireccionArmadoController@update')->name('cotizacion.armado.direccion.update')->middleware('permission:cotizacion.edit');
            Route::match(['DELETE'],'eliminar/{id_direccion}', 'Cotizacion\ArmadoCotizacion\DireccionArmado\DireccionArmadoController@destroy')->name('cotizacion.armado.direccion.destroy')->middleware('permission:cotizacion.edit');
        });

        Route::group(['prefix' => 'producto'], function() {
            Route::post('almacenar/{id_armado}', 'Cotizacion\ArmadoCotizacion\ProductoArmado\ProductoArmadoController@store')->name('cotizacion.armado.producto.store')->middleware('permission:cotizacion.edit');
            Route::match(['DELETE'],'eliminar/{id_producto}', 'Cotizacion\ArmadoCotizacion\ProductoArmado\ProductoArmadoController@destroy')->name('cotizacion.armado.producto.destroy')->middleware('permission:cotizacion.edit');  
            Route::match(['PUT', 'PATCH'],'actualizar-cantidad/{id_producto}/{id_armado}', 'Cotizacion\ArmadoCotizacion\ProductoArmado\ProductoArmadoController@updateCantidad')->name('cotizacion.armado.producto.updateCantidad')->middleware('permission:cotizacion.edit');
            Route::match(['PUT', 'PATCH'],'actualizar-utilidad/{id_producto}/{id_armado}', 'Cotizacion\ArmadoCotizacion\ProductoArmado\ProductoArmadoController@updateUtilidad')->name('cotizacion.armado.producto.updateUtilidad')->middleware('permission:cotizacion.edit');
        });
    });
});