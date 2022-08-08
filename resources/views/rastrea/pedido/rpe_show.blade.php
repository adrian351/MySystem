@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles pedido').' '.$pedido->num_pedido)</title>
<div class="card {{ empty($pedido->fech_de_entreg) ? config('app.color_card_danger') : config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ empty($pedido->fech_de_entreg) ? config('app.color_bg_danger') : config('app.color_bg_primario') }}">
    <div class="float-right mr-5">
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusVentasHeader')
    </div>
    <h5>
      <strong>{{ __('Datos generales, estas en el pedido') }}:</strong> {{ $pedido->num_pedido }}
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.entr_xprs_urg_foraneo_gratis')
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ empty($pedido->fech_de_entreg) ? config('app.color_bg_danger') : config('app.color_bg_primario') }}">
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('rastrea.pedido.rpe_showFields')
  </div>
</div>
@include('rastrea.pedido.armado.arm_index')
@include('rastrea.pedido.pago.pag_index')
@endsection