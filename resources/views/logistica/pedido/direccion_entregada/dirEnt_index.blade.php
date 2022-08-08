@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de direcciones entregadas'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('logistica.pedido.ped_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'logistica.direccionEntregada.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['num_pag' => 50, 'ruta_recarga' => route('logistica.direccionEntregada.index'), 'opciones_buscador' => config('opcionesSelect.select_logistica_direcciones_index')])
    {!! Form::close() !!}
    @include('logistica.pedido.direccion_entregada.dirEnt_table')
    @include('global.paginador.paginador', ['paginar' => $direcciones_entregadas])
  </div>
</div>
@endsection