<?php
/* ===================== [ RUTAS (CLIENTE) ] ===================== */
Route::group(['prefix' => 'cliente'], function() {
    Route::match(['GET', 'HEAD'],'', 'Cliente\ClienteController@index')->name('cliente.index')->middleware('permission:cliente.index|cliente.create|cliente.show|cliente.edit|cliente.destroy');
    Route::match(['GET', 'HEAD'],'crear', 'Cliente\ClienteController@create')->name('cliente.create')->middleware('permission:cliente.create');
    Route::post('almacenar', 'Cliente\ClienteController@store')->name('cliente.store')->middleware('permission:cliente.create');
    
    Route::group(['prefix' => 'detalles'], function() {
        Route::match(['GET', 'HEAD'],'actividad/{id_cliente}', 'Cliente\Show\ActividadController@index')->name('cliente.show.actividad.index')->middleware('permission:cliente.show');
        Route::match(['GET', 'HEAD'],'view/{id_cliente}', 'Cliente\ClienteController@show')->name('cliente.show')->middleware('permission:cliente.show');

        Route::group(['prefix' => 'direccion'], function() {
            Route::match(['GET', 'HEAD'],'{id_cliente}', 'Cliente\Show\DireccionController@index')->name('cliente.show.direccion.index')->middleware('permission:cliente.show|cliente.edit');
            Route::post('almacenar/{id_cliente}', 'Cliente\Show\DireccionController@store')->name('cliente.show.direccion.store')->middleware('permission:cliente.edit');
            Route::match(['GET', 'HEAD'],'detalles/{id_cliente}', 'Cliente\Show\DireccionController@show')->name('cliente.show.direccion.show')->middleware('permission:cliente.show');
        });

        Route::group(['prefix' => 'dato-fiscal'], function() {
            Route::match(['GET', 'HEAD'],'{id_cliente}', 'Cliente\Show\DatoFiscalController@index')->name('cliente.show.datoFiscal.index')->middleware('permission:cliente.show|cliente.edit');
            Route::post('almacenar/{id_cliente}', 'Cliente\Show\DatoFiscalController@store')->name('cliente.show.datoFiscal.store')->middleware('permission:cliente.edit');
            Route::match(['GET', 'HEAD'],'detalles/{id_cliente}', 'Cliente\Show\DatoFiscalController@show')->name('cliente.show.datoFiscal.show')->middleware('permission:cliente.show');
        });
        
        Route::match(['GET', 'HEAD'],'cotizacion/{id_cliente}', 'Cliente\Show\CotizacionController@index')->name('cliente.show.cotizacion.index')->middleware('permission:cliente.show');
        Route::match(['GET', 'HEAD'],'pedido/{id_cliente}', 'Cliente\Show\PedidoController@index')->name('cliente.show.pedido.index')->middleware('permission:cliente.show');
        Route::match(['GET', 'HEAD'],'factura/{id_cliente}', 'Cliente\Show\FacturaController@index')->name('cliente.show.factura.index')->middleware('permission:cliente.show');
        Route::match(['GET', 'HEAD'],'pago/{id_cliente}', 'Cliente\Show\PagoController@index')->name('cliente.show.pago.index')->middleware('permission:cliente.show');
        Route::match(['GET', 'HEAD'],'queja-y-sugerencia/{id_cliente}', 'Cliente\Show\QuejaYSugerenciaController@index')->name('cliente.show.quejaYSugerencia.index')->middleware('permission:cliente.show');
    });
    
    Route::match(['GET', 'HEAD'],'editar/{id_cliente}', 'Cliente\ClienteController@edit')->name('cliente.edit')->middleware('permission:cliente.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_usuario}', 'Cliente\ClienteController@update')->name('cliente.update')->middleware('permission:cliente.edit');
    Route::match(['DELETE'],'eliminar/{id_cliente}', 'Cliente\ClienteController@destroy')->name('cliente.destroy')->middleware('permission:cliente.destroy');
    Route::match(['GET', 'HEAD'],'re-enviar-correo-bienvenida/{id_cliente}', 'Cliente\ClienteController@reEnviarCorreoBienvenida')->name('cliente.reEnviarCorreoBienvenida')->middleware('permission:cliente.create');
});