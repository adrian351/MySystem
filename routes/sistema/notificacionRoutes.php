<?php
/* ===================== [ RUTAS SISTEMA (NOTIFICACIONES) ] ===================== */
Route::group(['prefix' => 'notificacion'], function() {
    Route::match(['GET', 'HEAD'],'enviar', 'Perfil\Notificacion\NotificacionController@create')->name('sistema.notificacion.create')->middleware('permission:sistema.notificacion.create');
    Route::post('almacenar', 'Perfil\Notificacion\NotificacionController@store')->name('sistema.notificacion.store')->middleware('permission:sistema.notificacion.create');
    Route::match(['GET', 'HEAD'],'eliminar-ficheros-notificaciones', 'Perfil\Notificacion\NotificacionController@eliminarFicherosNotificacion')->name('sistema.notificacion.eliminarFicherosNotificacion')->middleware('permission:sistema.notificacion.create');
});