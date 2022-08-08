@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de pagos (Individual)'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('pago.pag_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'pago.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('pago.index'), 'opciones_buscador' => config('opcionesSelect.select_pago_index')])
    {!! Form::close() !!}
    @include('pago.individual.ind_table')
    @include('global.paginador.paginador', ['paginar' => $pagos])
  </div>
</div>
@endsection