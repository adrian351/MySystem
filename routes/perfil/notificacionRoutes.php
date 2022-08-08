<?php
/* ===================== [ RUTAS PERFIL (NOTIFICACIONES) ] ===================== */
Route::group(['prefix' => 'notificacion'], function() {
    Route::match(['GET', 'HEAD'],'', 'Perfil\Notificacion\NotificacionController@index')->name('perfil.notificacion.index');
    //Rutas create estan dentro de sistema/notificacionRoutes.php
    Route::match(['GET', 'HEAD'],'detalles/{id_notificacion}/{id_notification}', 'Perfil\Notificacion\NotificacionController@show')->name('perfil.notificacion.show');
    Route::POST('marcar-como-visto', 'Perfil\Notificacion\NotificacionController@marcarComoVisto')->name('perfil.notificacion.marcarComoVisto');
    Route::POST('marcar-como-no-visto', 'Perfil\Notificacion\NotificacionController@marcarComoNoVisto')->name('perfil.notificacion.marcarComoNoVisto');
});