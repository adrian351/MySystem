@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles ruta').' '.$ruta->nom)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
        <a href="{{ route('rolFerro.ruta.edit', Crypt::encrypt($ruta->id)) }}" class="text-white">{{ $ruta->nom }}</a>
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $ruta->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('rolFerro.ruta.rut_showFields')
  </div>
</div>
@endsection