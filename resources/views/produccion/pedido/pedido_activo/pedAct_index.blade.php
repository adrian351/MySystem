@extends('layouts.private.escritorio.dashboard')
@include('produccion.pedido.pedido_activo.pedAct_pendientes')
@section('contenido')
<title>@section('title', __('Lista de pedidos activos producción'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('produccion.pedido.ped_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'produccion.pedidoActivo.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['num_pag' => 50, 'ruta_recarga' => route('produccion.pedidoActivo.index'), 'opciones_buscador' => config('opcionesSelect.select_produccion_pedido_activo_index')])
    {!! Form::close() !!}
    @include('produccion.pedido.pedido_activo.pedAct_table')
    @include('global.paginador.paginador', ['paginar' => $pedidos])
    @include('global.buscador.colores')
  </div>
</div>
@endsection
