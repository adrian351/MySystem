<?php
/* ===================== [ RUTAS PERFIL (PERFIL) ] ===================== */
Route::match(['GET', 'HEAD'],'detalles', 'Perfil\Perfil\PerfilController@show')->name('perfil.show');
Route::group(['middleware' => 'password.confirm'], function() {
    Route::match(['GET', 'HEAD'],'editar', 'Perfil\Perfil\PerfilController@edit')->name('perfil.edit');
    Route::match(['PUT', 'PATCH'],'actualizar', 'Perfil\Perfil\PerfilController@update')->name('perfil.update');

    /* ===================== [ RUTAS PERFIL (PERSONALIZAR SISTEMA) ] ===================== */
    Route::group(['prefix' => 'personalizarSistema'], function() {
        Route::match(['GET', 'HEAD'],'editar', 'Perfil\Perfil\PersonalizarSistemaController@edit')->name('perfil.personalizar.edit');
        Route::match(['PUT', 'PATCH'],'actualizar', 'Perfil\Perfil\PersonalizarSistemaController@update')->name('perfil.personalizar.update');
    });

    /* ===================== [ RUTAS PERFIL (ACTIVIDAD) ] ===================== */
    Route::group(['prefix' => 'actividad'], function() {
        Route::match(['GET', 'HEAD'],'', 'Perfil\Perfil\ActividadController@index')->name('perfil.actividad.index');
    });
});