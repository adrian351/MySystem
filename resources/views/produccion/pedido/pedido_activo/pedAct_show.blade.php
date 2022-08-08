@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles pedido activo producción').' '.$pedido->num_pedido)</title>
<div class="card {{ empty($pedido->lid_de_ped_produc) ? config('app.color_card_warning') : config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ empty($pedido->lid_de_ped_produc) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}">
    <div class="float-right mr-5">
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusProduccionHeader')
    </div>
    <h5>
      <strong>{{ __('Datos generales, estas en el pedido') }}: </strong>
      @can('produccion.pedidoActivo.edit')
        <a href="{{ route('produccion.pedidoActivo.edit', Crypt::encrypt($pedido->id)) }}" class="text-white">{{ $pedido->num_pedido }}</a>
      @else
        {{ $pedido->num_pedido }}
      @endcan
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.entr_xprs_urg_foraneo_gratis')
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ empty($pedido->lid_de_ped_produc) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}"> 
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
  @can('produccion.pedidoActivo.show')
    <div class="card-body">
      @include('produccion.pedido.pedido_activo.pedAct_showFields')
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
    @include('produccion.pedido.pedido_activo.armado_activo.armAct_index')
  </div>
</div>
@endsection