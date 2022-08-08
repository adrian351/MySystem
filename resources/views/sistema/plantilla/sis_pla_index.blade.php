@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de plantillas'))</title>
<div class="card">
  @include('sistema.sis_menu')
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'sistema.plantilla.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('sistema.plantilla.index'), 'opciones_buscador' => config('opcionesSelect.select_plantilla_index')])
    {!! Form::close() !!}
    @include('sistema.plantilla.sis_pla_table')
    @include('global.paginador.paginador', ['paginar' => $plantillas])
  </div>
</div>
@endsection