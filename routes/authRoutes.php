<?php
/* ===================== [ RUTAS (AUTH) ] ===================== */
Route::get('/', function () {
    return redirect('home');
});
Auth::routes(['register' => false]);