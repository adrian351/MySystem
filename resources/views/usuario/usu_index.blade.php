@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de usuarios'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('usuario.usu_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'usuario.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('usuario.index'), 'opciones_buscador' => config('opcionesSelect.select_usuario_index')])
    {!! Form::close() !!}
    @include('usuario.usu_table')
    @include('global.paginador.paginador', ['paginar' => $usuarios])
  </div>
</div>
@endsection