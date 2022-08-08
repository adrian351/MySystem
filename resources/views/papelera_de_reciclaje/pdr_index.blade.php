@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Papelera de reciclaje'))</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'papeleraDeReciclaje.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('papeleraDeReciclaje.index'), 'opciones_buscador' => config('opcionesSelect.select_papeleraDeReciclaje_index')])
    {!! Form::close() !!}
    @include('papelera_de_reciclaje.pdr_table')
    @include('global.paginador.paginador', ['paginar' => $registros])
  </div>
</div>
@endsection