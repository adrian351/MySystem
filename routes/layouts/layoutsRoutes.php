<?php
/* ===================== [ RUTAS (LAYOUTS) ] ===================== */
Route::group(['prefix' => 'layouts'], function() {
    Route::match(['GET', 'HEAD'],'', 'Layouts\LayoutsController@sidebar')->name('layouts.sidebar');
});