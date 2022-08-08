@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles cliente').' '.$cliente->nom)</title>
@include('cliente.show.cli_sho_menu')
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('cliente.edit')
        <a href="{{ route('cliente.edit', Crypt::encrypt($cliente->id)) }}" class="text-white">{{ $cliente->nom }}</a>
      @else
        {{ $cliente->nom }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $cliente->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('cliente.cli_showFields')
  </div>
</div>
@endsection