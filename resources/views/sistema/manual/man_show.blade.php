@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles manual').' '.$manual->valor)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('manual.edit')
        <a href="{{ route('manual.edit', Crypt::encrypt($manual->id)) }}" class="text-white">{{ $manual->valor }}</a>
      @else
        {{ $manual->valor }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $manual->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('sistema.manual.man_showFields')
  </div>
</div>
@endsection