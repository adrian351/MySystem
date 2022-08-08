<?php

Route::group(['prefix' => 'comprobante'], function() {
  Route::match(['GET', 'HEAD'],'', 'RolCliente\Comprobante\ComprobanteController@index')->name('rolCliente.comprobante.index');
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'RolCliente\Comprobante\ComprobanteController@show')->name('rolCliente.comprobante.show');
});