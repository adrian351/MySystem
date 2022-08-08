@extends('layouts.private.perfil.dashboard')
@section('titulo')
<div class="col-sm-6">
  <h1 class="m-0 text-dark"> {{ __('Notificaciones') }}</h1>
</div>
@endsection
@section('contenido')
<title>@section('title', __('Notificaciones'))</title>
<div class="card {{ config('app.color_card_primario') }} card-outline">
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'perfil.notificacion.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('perfil.notificacion.index'), 'opciones_buscador' => config('opcionesSelect.select_perfil_notificacion_index')])
    {!! Form::close() !!}
    <div class="mailbox-controls">
      <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm" id="marcarComoVisto" style="display: none;" title="{{ __('Marcar como visto') }}"  onClick='return marcarComoVisto()'><i class="fas fa-eye"></i></button>
        <button type="button" class="btn btn-default btn-sm" id="marcarComoNoVisto" style="display: none;" title="{{ __('Marcar como no visto') }}"  onClick='return marcarComoNoVisto()'><i class="fas fa-eye-slash"></i></button>
      </div>
    </div>
    @include('perfil.notificacion.per_not_table')
    @include('global.paginador.paginador', ['paginar' => $notificaciones])
  </div>
</div>
@endsection