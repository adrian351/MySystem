<?php
/* ===================== [ RUTAS (QUEJAS Y SUGERENCIAS) ] ===================== */
Route::group(['prefix' => 'qys'], function() {
    Route::match(['GET', 'HEAD'],'', 'QuejasYSugerencias\QuejasYSugerenciasController@index')->name('qys.index')->middleware('permission:qys.index|qys.show');
    Route::match(['GET', 'HEAD'],'registrar', 'QuejasYSugerencias\QuejasYSugerenciasController@create')->name('qys.create')->middleware('permission:qys.create');
    Route::post('almacenar', 'QuejasYSugerencias\QuejasYSugerenciasController@store')->name('qys.store')->middleware('permission:qys.create');
    Route::match(['GET', 'HEAD'],'detalles/{id_qys}', 'QuejasYSugerencias\QuejasYSugerenciasController@show')->name('qys.show')->middleware('permission:qys.show');
});