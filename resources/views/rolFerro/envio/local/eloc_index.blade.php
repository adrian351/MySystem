@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de envios'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('rolFerro.envio.local.eloc_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'rolFerro.envioLocal.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('rolFerro.envioLocal.index'), 'opciones_buscador' => config('opcionesSelect.select_logistica_direcciones_index')])
    {!! Form::close() !!}
    @include('rolFerro.envio.local.eloc_table')
    @include('global.paginador.paginador', ['paginar' => $envios])
  </div>
</div>
@endsection