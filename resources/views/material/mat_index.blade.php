@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de materiales'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('material.mat_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'material.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('material.index'), 'opciones_buscador' => config('opcionesSelect.select_material_index')])
    {!! Form::close() !!}
    @include('material.mat_table')
    @include('global.paginador.paginador', ['paginar' => $materiales])
  </div>
</div>
@endsection