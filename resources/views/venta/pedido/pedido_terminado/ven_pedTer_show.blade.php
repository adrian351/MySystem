@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles pedido').' '.$pedido->num_pedido)</title>
@if($pedido->est != 'Cerrado')
 @include('venta.pedido.pedido_terminado.ven_pedTer_edit')
@endif
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <div class="float-right mr-5">
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusVentasHeader')
    </div>
    <h5>
      <strong>{{ __('Datos generales, estas en el pedido') }}:</strong> {{ $pedido->num_pedido }}
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.entr_xprs_urg_foraneo_gratis')
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('venta.pedido.pedido_activo.ven_pedAct_showFields')
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <center><a href="{{ route('venta.pedidoTerminado.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
      </div>
    </div>
  </div>
</div>
<div class="row">
  @if (sizeof($pedido->archivos) != 0)
  @can('venta.pedidoActivo.edit')
    <div class="col-md-4">
      <div class="pad">
        @include('venta.pedido.pedido_activo.archivo.arc_index')
      </div>
    </div>
  @endcan
  @endif
  <div class="col-md">
    @include('venta.pedido.pedido_terminado.armado.arm_index')
  </div>
</div>
@include('venta.pedido.pedido_terminado.pago.pag_index')
@endsection