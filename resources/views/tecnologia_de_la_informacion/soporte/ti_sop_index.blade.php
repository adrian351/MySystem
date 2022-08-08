@extends('layouts.private.escritorio.dashboard') 
@section('contenido')
<title>@section('title', __('Lista de soportes'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('tecnologia_de_la_informacion.ti_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'soporte.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('soporte.index'), 'opciones_buscador' => config('opcionesSelect.select_soporte_index')])
    {!! Form::close() !!}
    @include('tecnologia_de_la_informacion.soporte.ti_sop_table')
    @include('global.paginador.paginador', ['paginar' => $soportes])
  </div>
</div>
@endsection