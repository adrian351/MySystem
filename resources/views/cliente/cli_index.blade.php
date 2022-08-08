@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de clientes'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('cliente.cli_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'cliente.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('cliente.index'), 'opciones_buscador' => config('opcionesSelect.select_cliente_index')])
    {!! Form::close() !!}
    @include('cliente.cli_table')
    @include('global.paginador.paginador', ['paginar' => $clientes])
  </div>
</div>
@endsection