@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de categorias'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('categoria.cat_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'categoria.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('categoria.index'), 'opciones_buscador' => config('opcionesSelect.select_categoria_index')])
    {!! Form::close() !!}
    @include('categoria.cat_table')
    @include('global.paginador.paginador', ['paginar' => $categorias])
  </div>
</div>
@endsection