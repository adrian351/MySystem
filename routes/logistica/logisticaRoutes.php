<?php
/* ===================== [ RUTAS (LOGÍSTICA) ] ===================== */
Route::match(['GET', 'HEAD'],'', 'Logistica\LogisticaController@index')->name('logistica.index')->middleware('permission:logistica.pedidoActivo.index|logistica.pedidoActivo.show|logistica.pedidoActivo.edit|logistica.pedidoActivo.armado.show|logistica.pedidoActivo.armado.edit|logistica.direccionLocal.index|logistica.direccionLocal.show|logistica.direccionLocal.create|logistica.direccionLocal.createEntrega|logistica.direccionForaneo.index|logistica.direccionForaneo.show|logistica.direccionForaneo.create|logistica.direccionForaneo.createEntrega|logistica.pedidoEntregado.index|logistica.pedidoEntregado.show|logistica.direccionLocal.edit|logistica.direccionForaneo.edit|logistica.direccionEntregada.edit');

