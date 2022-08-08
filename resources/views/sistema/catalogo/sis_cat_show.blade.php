@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles catálogo').' '.$catalogo->vista)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('sistema.catalogo.edit')
        <a href="{{ route('sistema.catalogo.edit', Crypt::encrypt($catalogo->id)) }}" class="text-white">{{ $catalogo->vista }}</a>
      @else
        {{ $catalogo->vista }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $catalogo->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('sistema.catalogo.sis_cat_showFields')
  </div>
</div>
@endsection