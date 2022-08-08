@extends('layouts.private.escritorio.dashboard') 
@section('contenido')
<title>@section('title', __('Lista de pedidos terminados almacén'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('almacen.pedido.alm_ped_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'almacen.pedidoTerminado.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['num_pag' => 50, 'ruta_recarga' => route('almacen.pedidoTerminado.index'), 'opciones_buscador' => config('opcionesSelect.select_almacen_pedido_activo_index')])
    {!! Form::close() !!}
    @include('almacen.pedido.pedido_terminado.pedTer_table')
    @include('global.paginador.paginador', ['paginar' => $pedidos])
  </div>
</div>
@endsection