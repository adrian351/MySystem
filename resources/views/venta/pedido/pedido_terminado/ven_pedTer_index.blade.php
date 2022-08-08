@extends('layouts.private.escritorio.dashboard')
@include('venta.pedido.pedido_terminado.ven_pedTer_filtros')
@section('contenido')
<title>@section('title', __('Lista de pedidos terminados'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('venta.pedido.ven_ped_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'venta.pedidoTerminado.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('venta.pedidoTerminado.index'), 'opciones_buscador' => config('opcionesSelect.select_venta_pedidoActivo_index')])
    {!! Form::close() !!}
    @include('venta.pedido.pedido_terminado.ven_pedTer_table')
    @include('global.paginador.paginador', ['paginar' => $pedidos])
  </div>
</div>
@endsection