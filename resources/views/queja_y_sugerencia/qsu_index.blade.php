@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de quejas y sugerencias'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('queja_y_sugerencia.qsu_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'qys.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('qys.index'), 'opciones_buscador' => config('opcionesSelect.select_qys_index')])
    {!! Form::close() !!}
    @include('queja_y_sugerencia.qsu_table')
    @include('global.paginador.paginador', ['paginar' => $quejas_y_sugerencias])
  </div>
</div>
@endsection