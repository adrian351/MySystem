<?php
/* ===================== [ RUTAS (PAPELERA DE RECICLAJE) ] ===================== */
Route::group(['prefix' => 'papelera-de-reciclaje'], function() {
    Route::match(['GET', 'HEAD'],'', 'PapeleraDeReciclaje\PapeleraDeReciclajeController@index')->name('papeleraDeReciclaje.index')->middleware('permission:papeleraDeReciclaje.index|papeleraDeReciclaje.destroy|papeleraDeReciclaje.restore');
    Route::match(['DELETE'],'eliminar/{id_registro}', 'PapeleraDeReciclaje\PapeleraDeReciclajeController@destroy')->name('papeleraDeReciclaje.destroy')->middleware('permission:papeleraDeReciclaje.destroy');
    Route::match(['GET', 'HEAD'],'restaurar/{id_registro}', 'PapeleraDeReciclaje\PapeleraDeReciclajeController@restore')->name('papeleraDeReciclaje.restore')->middleware('permission:papeleraDeReciclaje.restore');
});