@extends('layouts.private.escritorio.dashboard') 
@section('contenido')
<title>@section('title', __('Lista de inventario'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('tecnologia_de_la_informacion.inventarioEquipo.ti_inv_menu')
    </ul> 
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'inventario.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('inventario.index'), 'opciones_buscador' => config('opcionesSelect.select_inventario_index')])
    {!! Form::close() !!}
    @include('tecnologia_de_la_informacion.inventarioEquipo.ti_inv_table')
    @include('global.paginador.paginador', ['paginar' => $inventarios])
  </div>
</div>
@endsection