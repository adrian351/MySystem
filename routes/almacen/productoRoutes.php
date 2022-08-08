<?php
/* ===================== [ RUTAS ALMACÉN (PRODUCTO) ] ===================== */
Route::group(['prefix' => 'producto'], function() {
  Route::match(['GET', 'HEAD'],'', 'Almacen\Producto\ProductoController@index')->name('almacen.producto.index')->middleware('permission:almacen.producto.index|almacen.producto.create|almacen.producto.show|almacen.producto.edit|almacen.producto.disminuirStock|almacen.producto.destroy|almacen.producto.editValidado|almacen.producto.editHabilitado|almacen.producto.sustituto.create|almacen.producto.sustituto.destroy|almacen.producto.proveedor.create|almacen.producto.proveedor.edit|almacen.producto.proveedor.destroy');
  Route::match(['GET', 'HEAD'],'crear', 'Almacen\Producto\ProductoController@create')->name('almacen.producto.create')->middleware('permission:almacen.producto.create');
  Route::post('almacenar', 'Almacen\Producto\ProductoController@store')->name('almacen.producto.store')->middleware('permission:almacen.producto.create');
  Route::match(['GET', 'HEAD'],'detalles/{id_producto}', 'Almacen\Producto\ProductoController@show')->name('almacen.producto.show')->middleware('permission:almacen.producto.show');
  Route::match(['GET', 'HEAD'],'editar/{id_producto}', 'Almacen\Producto\ProductoController@edit')->name('almacen.producto.edit')->middleware('permission:almacen.producto.edit|almacen.producto.editValidado|almacen.producto.editHabilitado|almacen.producto.disminuirStock|almacen.producto.sustituto.create|almacen.producto.sustituto.destroy|almacen.producto.proveedor.create|almacen.producto.proveedor.edit|almacen.producto.proveedor.destroy');
      
  Route::group(['prefix' => 'actualizar'], function() {
    Route::match(['PUT', 'PATCH'],'{id_producto}', 'Almacen\Producto\ProductoController@update')->name('almacen.producto.update')->middleware('permission:almacen.producto.edit');
    Route::match(['PUT', 'PATCH'],'validado/{id_producto}', 'Almacen\Producto\ProductoController@updateValidado')->name('almacen.producto.updateValidado')->middleware('permission:almacen.producto.editValidado');
    Route::match(['PUT', 'PATCH'],'habilitado/{id_producto}', 'Almacen\Producto\ProductoController@updateHabilitado')->name('almacen.producto.updateHabilitado')->middleware('permission:almacen.producto.editHabilitado');
    Route::match(['PUT', 'PATCH'],'aumentar-stock/{id_producto}', 'Almacen\Producto\ProductoController@aumentarStock')->name('almacen.producto.aumentarStock')->middleware('permission:almacen.producto.edit');
    Route::match(['PUT', 'PATCH'],'disminuir-stock/{id_producto}', 'Almacen\Producto\ProductoController@disminuirStock')->name('almacen.producto.disminuirStock')->middleware('permission:almacen.producto.disminuirStock');
  }); 
  
  Route::match(['DELETE'],'eliminar/{id_producto}', 'Almacen\Producto\ProductoController@destroy')->name('almacen.producto.destroy')->middleware('permission:almacen.producto.destroy');
  Route::match(['GET', 'HEAD'],'precio-proveedor', 'Almacen\Producto\ProductoController@getPrecioProveedor')->name('almacen.producto.getPrecioProveedor')->middleware('permission:almacen.producto.edit');

  Route::match(['GET', 'HEAD'],'generar-reporte-de-producto', 'Almacen\Producto\ProductoController@generarReporteDeProducto')->name('almacen.producto.generarReporteDeProducto')->middleware('permission:almacen.producto.index');

  Route::match(['GET', 'HEAD'],'generar-reporte-de-sustitutos', 'Almacen\Producto\ProductoController@generarReporteDeSustitutos')->name('almacen.producto.generarReporteDeSustitutos')->middleware('permission:almacen.producto.index');

  Route::match(['POST'],'generar-reporte-de-compra', 'Almacen\Producto\ProductoController@generarReporteDeCompra')->name('almacen.producto.generarReporteDeCompra')->middleware('permission:almacen.producto.index');

  Route::match(['GET', 'HEAD'],'generar-reporte-de-stock', 'Almacen\Producto\ProductoController@generarReporteDeStock')->name('almacen.producto.generarReporteDeStock')->middleware('permission:almacen.producto.index');

  Route::group(['prefix' => 'imagen'], function() {
    Route::post('almacenar/{id_armado}', 'Almacen\Producto\Imagen\ImagenController@store')->name('almacen.producto.imagen.store')->middleware('permission:almacen.producto.edit');
    Route::match(['DELETE'],'eliminar/{id_imagen}', 'Almacen\Producto\Imagen\ImagenController@destroy')->name('almacen.producto.imagen.destroy')->middleware('permission:almacen.producto.edit');
  });

  Route::group(['prefix' => 'sustituto'], function() {
    Route::post('almacenar/{id_producto}', 'Almacen\Producto\SustitutoProducto\SustitutoProductoController@store')->name('almacen.producto.sustituto.store')->middleware('permission:almacen.producto.sustituto.create');
    Route::match(['DELETE'],'eliminar/{id_producto}/{id_sustituto}', 'Almacen\Producto\SustitutoProducto\SustitutoProductoController@destroy')->name('almacen.producto.sustituto.destroy')->middleware('permission:almacen.producto.sustituto.destroy');
  });

  Route::group(['prefix' => 'proveedor'], function() {
    Route::match(['GET', 'HEAD'],'registrar/{id_producto}', 'Almacen\Producto\ProveedorProducto\ProveedorProductoController@create')->name('almacen.producto.proveedor.create')->middleware('permission:almacen.producto.proveedor.create');
    Route::post('almacenar/{id_producto}', 'Almacen\Producto\ProveedorProducto\ProveedorProductoController@store')->name('almacen.producto.proveedor.store')->middleware('permission:almacen.producto.proveedor.create');
    Route::match(['GET', 'HEAD'],'editar/{id_producto}/{id_proveedor}', 'Almacen\Producto\ProveedorProducto\ProveedorProductoController@edit')->name('almacen.producto.proveedor.edit')->middleware('permission:almacen.producto.proveedor.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_producto}/{id_proveedor}', 'Almacen\Producto\ProveedorProducto\ProveedorProductoController@update')->name('almacen.producto.proveedor.update')->middleware('permission:almacen.producto.proveedor.edit');
    Route::match(['DELETE'],'eliminar/{id_producto}/{id_proveedor}', 'Almacen\Producto\ProveedorProducto\ProveedorProductoController@destroy')->name('almacen.producto.proveedor.destroy')->middleware('permission:almacen.producto.proveedor.destroy');
  });

  Route::group(['prefix' => 'precios'], function() {
    Route::match(['GET', 'HEAD'],'crear/{id_producto}', 'Almacen\Producto\Precio\PrecioController@create')->name('almacen.producto.precio.create')->middleware('permission:almacen.producto.edit');
    Route::post('almacenar/{id_producto}', 'Almacen\Producto\Precio\PrecioController@store')->name('almacen.producto.precio.store')->middleware('permission:almacen.producto.edit');
    Route::match(['DELETE'],'eliminar/{id_precio}', 'Almacen\Producto\Precio\PrecioController@destroy')->name('almacen.producto.precio.destroy')->middleware('permission:almacen.producto.edit');
  });

  Route::group(['prefix' => 'nota'], function() {
    Route::post('almacenar/{id_producto}', 'Almacen\Producto\NotaRemision\NotaRemisionController@store')->name('almacen.producto.nota.store')->middleware('permission:almacen.nota.create|almacen.producto.edit');
});
  
});