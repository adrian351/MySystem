@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de rutas'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('rolFerro.ruta.rut_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'rolFerro.ruta.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('rolFerro.ruta.index'), 'opciones_buscador' => config('opcionesSelect.select_rolFerro_ruta_index')])
    {!! Form::close() !!}
    @include('rolFerro.ruta.rut_table')
    @include('global.paginador.paginador', ['paginar' => $rutas])
  </div>
</div>
@endsection