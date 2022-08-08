@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles proveedor').' '.$proveedor->nom_comerc)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    @include('proveedor.pro_archivo')
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('proveedor.edit')
        <a href="{{ route('proveedor.edit', Crypt::encrypt($proveedor->id)) }}" class="text-white">{{ $proveedor->nom_comerc }}</a>
      @else
        {{ $proveedor->nom_comerc }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $proveedor->id }}</small>
    </div>
  </div>
  @can('proveedor.show')
    <div class="card-body">
      @include('proveedor.pro_showFields')
    </div>
  @endcan
</div>
@include('proveedor.contacto_proveedor.pro_conPro_index')
@include('proveedor.productos.pro_index')
@endsection