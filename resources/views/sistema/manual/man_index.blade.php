@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de manuales'))</title>
<div class="card">
  @include('sistema.sis_menu')
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'manual.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('manual.index'), 'opciones_buscador' => config('opcionesSelect.select_manual_index')])
    {!! Form::close() !!}
    @include('sistema.manual.man_table')
    @include('global.paginador.paginador', ['paginar' => $manuales])
  </div>
</div>
@endsection