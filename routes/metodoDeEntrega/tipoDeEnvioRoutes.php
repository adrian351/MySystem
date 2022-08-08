<?php
/* ===================== [ RUTAS (TIPOS DE ENVIO) ] ===================== */
Route::group(['prefix' => 'metodo-de-entrega'], function() {
  Route::match(['GET', 'HEAD'],'obtener/{metodo_de_entrega}', 'MetodoDeEntrega\TipoDeEnvio\TipoDeEnvioController@getTiposDeEnvio')->name('metodoDeEntrega.getTiposDeEnvio')->middleware('permission:costoDeEnvio.create|costoDeEnvio.edit');
});