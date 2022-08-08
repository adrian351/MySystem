@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de datos fiscales'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('rolCliente.datoFiscal.dfi_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'rolCliente.datoFiscal.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('rolCliente.datoFiscal.index'), 'opciones_buscador' => config('opcionesSelect.select_datos_fiscales_index')])
    {!! Form::close() !!}
    @include('rolCliente.datoFiscal.dfi_table')
    @include('global.paginador.paginador', ['paginar' => $datos_fiscales])
  </div>
</div>
@endsection