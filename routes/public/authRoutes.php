<?php
/* ===================== [ RUTAS (PUBLIC) ] ===================== */
Route::get('/', function () {
    return redirect('home');
});
Auth::routes(['register' => false]);