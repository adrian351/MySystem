<?php
/* ===================== [ RUTAS (USUARIO) ] ===================== */
Route::match(['GET', 'HEAD'],'', 'Job\JobController@indexJob')->name('job.index')->middleware('permission:logs.index');

Route::group(['prefix' => 'failed'], function() {
  Route::match(['GET', 'HEAD'],'', 'Job\JobController@indexFailedJob')->name('failedJob.index')->middleware('permission:logs.index');
});