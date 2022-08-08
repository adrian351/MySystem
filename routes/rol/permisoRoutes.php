<?php
/* ===================== [ RUTAS (PERMISOS) ] ===================== */
Route::group(['prefix' => 'permiso'], function() {
  Route::match(['GET', 'HEAD'],'', 'Rol\PermisoController@index')->name('rol.permiso.index')->middleware('permission:rol.permiso.index|rol.create|rol.show|rol.edit');
  Route::match(['GET', 'HEAD'],'detalles/{id_permiso}', 'Rol\PermisoController@show')->name('rol.permiso.show')->middleware('permission:rol.permiso.index|rol.create|rol.show|rol.edit');
});