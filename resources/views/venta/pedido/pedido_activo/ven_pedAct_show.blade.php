@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles pedido').' '.$pedido->num_pedido)</title>
<div class="card {{ empty($pedido->fech_de_entreg) ? config('app.color_card_danger') : config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ empty($pedido->fech_de_entreg) ? config('app.color_bg_danger') : config('app.color_bg_primario') }}">
    <div class="float-right mr-5">
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusVentasHeader')
    </div>
    <h5>
      <strong>{{ __('Datos generales, estas en el pedido') }}:</strong>
      @can('venta.pedidoActivo.edit')
        <a href="{{ route('venta.pedidoActivo.edit', Crypt::encrypt($pedido->id)) }}" class="text-white">{{ $pedido->num_pedido }}</a>
      @else
        {{ $pedido->num_pedido }}
      @endcan
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.entr_xprs_urg_foraneo_gratis')
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ empty($pedido->fech_de_entreg) ? config('app.color_bg_danger') : config('app.color_bg_primario') }}">
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
  @can('venta.pedidoActivo.show')
    <div class="card-body">
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields')
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <center><a href="{{ route('venta.pedidoActivo.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
        </div>
      </div>
    </div>
  @endcan
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
    @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_arm_pedAct_index')
  </div>
</div>
@include('venta.pedido.pedido_activo.pago_pedidoActivo.ven_pedAct_pag_index')
@endsection