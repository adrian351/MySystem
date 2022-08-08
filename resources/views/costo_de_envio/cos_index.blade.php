@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de costos de envío'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('costo_de_envio.cos_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'costoDeEnvio.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('costoDeEnvio.index'), 'opciones_buscador' => config('opcionesSelect.select_costos_de_envio_index')])
    {!! Form::close() !!}
    @include('costo_de_envio.cos_table')
    @include('global.paginador.paginador', ['paginar' => $costos_de_envio])
  </div>
</div>
@endsection