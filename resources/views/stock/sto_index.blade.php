@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de stock'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('stock.sto_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'stock.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('stock.index'), 'opciones_buscador' => []])
    {!! Form::close() !!}
    @include('stock.sto_table')
    @include('global.paginador.paginador', ['paginar' => $stocks])
  </div>
</div>
@endsection