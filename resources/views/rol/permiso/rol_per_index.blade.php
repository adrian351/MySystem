@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de permisos'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('rol.rol_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'rol.permiso.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('rol.permiso.index'), 'opciones_buscador' => config('opcionesSelect.select_rol__permiso_index')])
    {!! Form::close() !!}
    @include('rol.permiso.rol_per_table')
    @include('global.paginador.paginador', ['paginar' => $permisos])
  </div>
</div>
@endsection