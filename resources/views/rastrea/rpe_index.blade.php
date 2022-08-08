@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Rastrear pedido'))</title>
<div class="card">
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'rastrea.pedido.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('rastrea.pedido.index'), 'opciones_buscador' => config('opcionesSelect.select_rastrear_pedido_index')])
    {!! Form::close() !!}
    @include('rastrea.rpe_table')
    @include('global.paginador.paginador', ['paginar' => $pedidos])
  </div>
</div>
@endsection