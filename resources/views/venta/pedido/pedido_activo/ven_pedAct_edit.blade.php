@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pedido').' '.$pedido->num_pedido)</title>
<div class="card {{ empty($pedido->fech_de_entreg) ? config('app.color_card_danger') : config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ empty($pedido->fech_de_entreg) ? config('app.color_bg_danger') : config('app.color_bg_primario') }}">
    <div class="float-right mr-5">
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusVentasHeader')
    </div>
    <h5>
      <strong>{{ __('Datos generales, estas en el pedido') }}:</strong>
      @can('venta.pedidoActivo.show')
        <a href="{{ route('venta.pedidoActivo.show', Crypt::encrypt($pedido->id)) }}" class="text-white">{{ $pedido->num_pedido }}</a>
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
</div>
<div class="row">
  @can('venta.pedidoActivo.edit')
    <div class="col-md-7">
      <div class="pad">
          <div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
            <div class="card-body">
              {!! Form::open(['route' => ['venta.pedidoActivo.update', Crypt::encrypt($pedido->id)], 'method' => 'patch', 'id' => 'ventaPedidoActivoUpdate', 'files' => true]) !!}
                @include('venta.pedido.pedido_activo.ven_pedAct_editFields')
              {!! Form::close() !!}
            </div>
          </div>
      </div>
    </div>
  @endcan
  @if (sizeof($pedido->unificar) != 0)
    @include('venta.pedido.pedido_activo.ven_pedAct_showFields.numeroDePedidoUnificado', ['alto' => 'height: 23em;'])
    @else
    <div class="col-sm">
      @include('venta.pedido.pedido_activo.archivo.arc_index')
    </div>
  @endif
  
</div>
<div class="row">
  @if (sizeof($pedido->unificar) != 0)
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