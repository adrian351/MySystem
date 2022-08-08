@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles armado entregado logística').' '.$armado->cod)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Datos generales del armado') }}:</strong> {{ $armado->cod }}
      <strong>{{ __('estas en el pedido') }}:</strong> {{ $armado->pedido->num_pedido }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $armado->cod }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('logistica.pedido.pedido_activo.armado_activo.armAct_showFields')
  </div>
</div>
@include('logistica.pedido.pedido_entregado.armado_entregado.direccion_armado.dirArm_index')
@endsection