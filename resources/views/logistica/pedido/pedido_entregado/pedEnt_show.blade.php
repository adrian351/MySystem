@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles pedido entregado logística').' '.$pedido->num_pedido)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <div class="float-right mr-5">
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusLogisticaHeader')
    </div>
    <h5>
      <strong>{{ __('Datos generales, estas en el pedido') }}: </strong>{{ $pedido->num_pedido }}
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.entr_xprs_urg_foraneo_gratis')
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
  @can('logistica.pedidoEntregado.show')
    <div class="card-body">
      @include('logistica.pedido.pedido_entregado.pedEnt_showFields')
    </div>
  @endcan
</div>
<div class="row">
  @can('venta.pedidoActivo.edit')
    <div class="col-md-4">
      <div class="pad">
        @include('venta.pedido.pedido_activo.archivo.arc_index')
      </div>
    </div>
  @endcan
  <div class="col-md-8">
    @include('logistica.pedido.pedido_entregado.armado_entregado.armEnt_index')
  </div>
</div>
@endsection