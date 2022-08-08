@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de cotizaciones'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('cotizacion.cot_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'cotizacion.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('cotizacion.index'), 'opciones_buscador' => config('opcionesSelect.select_cotizacion_index')])
    {!! Form::close() !!}
    @include('cotizacion.cot_table')
    @include('global.paginador.paginador', ['paginar' => $cotizaciones])
  </div>
</div>
@endsection