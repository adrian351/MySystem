<?php
/* ===================== [ RUTAS (ROLES) ] ===================== */
Route::match(['GET', 'HEAD'],'', 'Rol\RolController@index')->name('rol.index')->middleware('permission:rol.index|rol.create|rol.show|rol.edit|rol.destroy');
Route::match(['GET', 'HEAD'],'crear', 'Rol\RolController@create')->name('rol.create')->middleware('permission:rol.create');
Route::post('almacenar', 'Rol\RolController@store')->name('rol.store')->middleware('permission:rol.create');
Route::match(['GET', 'HEAD'],'detalles/{id_rol}', 'Rol\RolController@show')->name('rol.show')->middleware('permission:rol.show');
Route::match(['GET', 'HEAD'],'editar/{id_rol}', 'Rol\RolController@edit')->name('rol.edit')->middleware('permission:rol.edit');
Route::match(['PUT', 'PATCH'],'actualizar/{id_rol}', 'Rol\RolController@update')->name('rol.update')->middleware('permission:rol.edit');
Route::match(['DELETE'],'eliminar/{id_rol}', 'Rol\RolController@destroy')->name('rol.destroy')->middleware('permission:rol.destroy');