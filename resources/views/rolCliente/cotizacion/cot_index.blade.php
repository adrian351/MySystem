@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de cotizaciones'))</title>
<div class="shadow-lg p-2 mb-3 bg-body rounded bg-info">
  <center>
    <h5>
      <strong>{{ __('Cotizaciones') }}</strong> 
    </h5>
  </center>
</div>
<div class="card">
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'rolCliente.cotizacion.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('rolCliente.cotizacion.index'), 'opciones_buscador' => config('opcionesSelect.select_cliente_cotizacion_index')])
    {!! Form::close() !!}
    @include('rolCliente.cotizacion.cot_table')
    @include('global.paginador.paginador', ['paginar' => $cotizaciones])
  </div>
</div>
@endsection