@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de Marcas'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('marcas.marca_menu')
    </ul>
  </div>
  <div class="card-body">
    {{--  {!! Form::model(Request::all(), ['route' => 'marca.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('marca.index'), 'opciones_buscador' => config('opcionesSelect.select_categoria_index')])
    {!! Form::close() !!}  --}}
    @include('marcas.marca_table')
    @include('global.paginador.paginador', ['paginar' => $marcas])
  </div>
</div>
@endsection