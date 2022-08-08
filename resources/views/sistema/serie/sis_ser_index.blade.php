@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de series'))</title>
<div class="card">
  @include('sistema.sis_menu')
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'sistema.serie.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('sistema.serie.index'), 'opciones_buscador' => config('opcionesSelect.select_serie_index')])
    {!! Form::close() !!}
    @include('sistema.serie.sis_ser_table')
    @include('global.paginador.paginador', ['paginar' => $series])
  </div>
</div>
@endsection