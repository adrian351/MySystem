@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles cotización').' '.$cotizacion->cliente->email_registro )</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton bg-primary">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong> {{ $cotizacion->cliente->email_registro  }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $cotizacion->serie }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('rolCliente.cotizacion.cot_showFields')
  </div>
</div>
@include('rolCliente.cotizacion.armado.arm_index')
@endsection