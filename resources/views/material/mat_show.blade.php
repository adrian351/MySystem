@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles material').' '.$material->sku)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('material.edit')
        <a href="{{ route('material.edit', Crypt::encrypt($material->id)) }}" class="text-white">{{ $material->sku }}</a>
      @else
        {{ $material->sku }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $material->sku }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('material.mat_showFields')
  </div>
</div>
@endsection