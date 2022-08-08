@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de armados'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('armado.arm_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'armado.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('armado.index'), 'opciones_buscador' => config('opcionesSelect.select_armado_index')])
    {!! Form::close() !!}
    @include('armado.arm_table')
    @include('global.paginador.paginador', ['paginar' => $armados])
  </div>
</div>
@endsection