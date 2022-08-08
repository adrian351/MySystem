@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles stock').' '.$stock->armados[0]->nom)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('stock.edit')
        <a href="{{ route('stock.edit', Crypt::encrypt($stock->id)) }}" class="text-white">{{ $stock->armados[0]->nom }}</a>
      @else
        {{ $stock->armados[0]->nom }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $stock->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('stock.sto_showFields')
  </div>
</div>
@endsection