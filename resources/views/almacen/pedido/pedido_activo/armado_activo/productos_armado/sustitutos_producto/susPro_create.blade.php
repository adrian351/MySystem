@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Agregar sustituto al producto').' '.$producto->sku)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Agregar sustituto al producto') }}: </strong>{{ $producto->sku }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $producto->sku }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['almacen.pedidoActivo.armado.sistituto.store', Crypt::encrypt($producto->id)], 'id' => 'almacenPedidoActivoArmadoSistitutoStore']) !!}
      @include('almacen.pedido.pedido_activo.armado_activo.productos_armado.sustitutos_producto.susPro_createFields')
    {!! Form::close() !!}
  </div>
</div>
<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    <h5>
      <strong>{{ __('Sustitutos') }} </strong>
    </h5>
  </div>
  <div class="card-body">
    @include('almacen.pedido.pedido_activo.armado_activo.productos_armado.sustitutos_producto.susPro_table')
    @include('global.paginador.paginador', ['paginar' => $sustitutos])
  </div>
</div>
@endsection