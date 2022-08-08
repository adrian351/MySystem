@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles contacto o sucursal').' '.$contacto->nom)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('proveedor.contacto.edit')
        <a href="{{ route('proveedor.contacto.edit', Crypt::encrypt($contacto->id)) }}" class="text-white">{{ $contacto->nom }}</a>
      @else
        {{ $contacto->nom }}
      @endcan
      <strong>{{ __('del proveedor') }}:</strong> {{ $contacto->proveedor->nom_comerc }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $contacto->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('proveedor.contacto_proveedor.pro_conPro_showFields')
  </div>
</div>
@endsection