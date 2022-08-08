@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de roles'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('rol.rol_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'rol.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('rol.index'), 'opciones_buscador' => config('opcionesSelect.select_rol_index')])
    {!! Form::close() !!}
    @include('rol.rol.rol_rol_table')
    @include('global.paginador.paginador', ['paginar' => $roles])
  </div>
</div>
@endsection