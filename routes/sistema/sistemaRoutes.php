<?php
/* ===================== [ RUTAS SISTEMA (SISTEMA) ] ===================== */
Route::match(['GET', 'HEAD'],'editar', 'Sistema\SistemaController@edit')->name('sistema.edit')->middleware('permission:sistema.edit');
Route::match(['PUT', 'PATCH'],'actualizar', 'Sistema\SistemaController@update')->name('sistema.update')->middleware('permission:sistema.edit');