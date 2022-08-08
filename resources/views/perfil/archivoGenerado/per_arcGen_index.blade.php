@extends('layouts.private.perfil.dashboard')
@section('titulo')
<div class="col-sm-6">
  <h1 class="m-0 text-dark"> {{ __('Archivos generados') }}</h1>
</div>
@endsection
@section('contenido')
<title>@section('title', __('Archivos generados'))</title>
<div class="card {{ config('app.color_card_primario') }} card-outline">
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'perfil.archivoGenerado.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('perfil.archivoGenerado.index'), 'opciones_buscador' => config('opcionesSelect.select_perfil_archivoGenerado_index')])
    {!! Form::close() !!}
    @include('perfil.archivoGenerado.per_arcGen_table')
    @include('global.paginador.paginador', ['paginar' => $archivos_generados])
  </div>
</div>
@endsection