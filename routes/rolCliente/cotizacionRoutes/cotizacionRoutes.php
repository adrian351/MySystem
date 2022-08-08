<?php
/* ===================== [ RUTAS (COTIZACION) ] ===================== */
Route::group(['prefix' => 'cotizacion'], function() {
    Route::match(['GET', 'HEAD'],'', 'RolCliente\Cotizacion\CotizacionController@index')->name('rolCliente.cotizacion.index');
    Route::match(['GET', 'HEAD'],'detalles/{id_dato_fiscal}', 'RolCliente\Cotizacion\CotizacionController@show')->name('rolCliente.cotizacion.show');
});