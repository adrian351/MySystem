@extends('layouts.private.escritorio.dashboard')
@include('logistica.pedido.pedido_activo.pedAct_pendientes')
@section('contenido')
<title>@section('title', __('Lista de pedidos activos'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('logistica.pedido.ped_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'logistica.pedidoActivo.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['num_pag' => 50, 'ruta_recarga' => route('logistica.pedidoActivo.index'), 'opciones_buscador' => config('opcionesSelect.select_logistica_pedido_activo_local_index')])
    {!! Form::close() !!}
    @include('logistica.pedido.pedido_activo.pedAct_table')
    @include('global.paginador.paginador', ['paginar' => $pedidos])
    @include('global.buscador.colores')
  </div>
</div>
@endsection