@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de etiquetas'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('etiqueta.eti_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'etiqueta.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('etiqueta.index'), 'opciones_buscador' => config('opcionesSelect.select_etiqueta_index')])
    {!! Form::close() !!}
    @include('etiqueta.eti_table')
    @include('global.paginador.paginador', ['paginar' => $etiquetas])
  </div>
</div>
@endsection