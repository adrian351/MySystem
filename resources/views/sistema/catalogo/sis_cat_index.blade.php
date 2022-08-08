@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de catálogos'))</title>
<div class="card">
  @include('sistema.sis_menu')
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'sistema.catalogo.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('sistema.catalogo.index'), 'opciones_buscador' => config('opcionesSelect.select_catalogo_index')])
    {!! Form::close() !!}
    @include('sistema.catalogo.sis_cat_table')
    @include('global.paginador.paginador', ['paginar' => $catalogos])
  </div>
</div>
@endsection