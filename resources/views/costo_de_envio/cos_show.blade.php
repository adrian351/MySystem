@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles costo de envío').' '.$costo_de_envio->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('costoDeEnvio.edit')
        <a href="{{ route('costoDeEnvio.edit', Crypt::encrypt($costo_de_envio->id)) }}" class="text-white">{{ $costo_de_envio->est }}</a>
      @else
        {{ $costo_de_envio->est }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $costo_de_envio->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('costo_de_envio.cos_showFields')
  </div>
</div>
@endsection