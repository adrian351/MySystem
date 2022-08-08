<?php
/* ===================== [ RUTAS (USUARIO) ] ===================== */
Route::group(['prefix' => 'usuario'], function() {
  Route::match(['GET', 'HEAD'],'', 'Usuario\UsuarioController@index')->name('usuario.index')->middleware('permission:usuario.index|usuario.create|usuario.show|usuario.edit|usuario.destroy');
  Route::match(['GET', 'HEAD'],'crear', 'Usuario\UsuarioController@create')->name('usuario.create')->middleware('permission:usuario.create');
  Route::post('almacenar', 'Usuario\UsuarioController@store')->name('usuario.store')->middleware('permission:usuario.create');

  Route::group(['prefix' => 'detalles'], function() {
    Route::match(['GET', 'HEAD'],'actividad/{id_usuario}', 'Usuario\Show\ActividadController@index')->name('usuario.show.actividad.index')->middleware('permission:usuario.show');
    Route::match(['GET', 'HEAD'],'d/{id_usuario}', 'Usuario\UsuarioController@show')->name('usuario.show')->middleware('permission:usuario.show');
    Route::match(['GET', 'HEAD'],'queja-y-sugerencia/{id_usuario}', 'Usuario\Show\QuejaYSugerenciaController@index')->name('usuario.show.quejaYSugerencia.index')->middleware('permission:usuario.show');
  });

  Route::match(['GET', 'HEAD'],'editar/{id_usuario}', 'Usuario\UsuarioController@edit')->name('usuario.edit')->middleware('permission:usuario.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_usuario}', 'Usuario\UsuarioController@update')->name('usuario.update')->middleware('permission:usuario.edit');
  Route::match(['DELETE'],'eliminar/{id_usuario}', 'Usuario\UsuarioController@destroy')->name('usuario.destroy')->middleware('permission:usuario.destroy');
  Route::match(['GET', 'HEAD'],'re-enviar-correo-bienvenida/{id_usuario}', 'Usuario\UsuarioController@reEnviarCorreoBienvenida')->name('usuario.reEnviarCorreoBienvenida')->middleware('permission:usuario.create');

  Route::match(['GET', 'HEAD'],'generar-reporte-de-usuario', 'Usuario\UsuarioController@UsuariosXLSXExport')->name('usuario.UsuariosXLSXExport')->middleware('permission:usuario.index');
});