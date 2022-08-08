@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles serie').' '.$serie->vista)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('sistema.serie.edit')
        <a href="{{ route('sistema.serie.edit', Crypt::encrypt($serie->id)) }}" class="text-white">{{ $serie->vista }}</a>
      @else
        {{ $serie->vista }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $serie->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('sistema.serie.sis_ser_showFields')
  </div>
</div>
@endsection