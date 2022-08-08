@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles producto').' '.$producto->produc)</title>
<div class="card {{ empty($producto->stock < $producto->min_stock) ? config('app.color_card_primario') : config('app.color_card_warning') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ empty($producto->stock < $producto->min_stock) ? config('app.color_bg_primario') : config('app.color_bg_warning') }}">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('almacen.producto.edit')
      <a href="{{ route('almacen.producto.edit', Crypt::encrypt($producto->id)) }}" class="text-white">{{ $producto->produc }}</a>
      @else
        {{ $producto->produc }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ empty($producto->stock < $producto->min_stock) ? config('app.color_bg_primario') : config('app.color_bg_warning') }}">
      <small>{{ $producto->id }}</small>
    </div>
  </div>
</div>
@include('almacen.producto.imagenes.img_index')
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-body">
    @include('almacen.producto.alm_pro_showFields')
  </div>
</div>
@include('almacen.producto.proveedor_producto.alm_pro_proPro_index')
@include('almacen.producto.sustitutos_producto.alm_pro_susPro_index')
@include('almacen.producto.precios.pre_index')
@endsection