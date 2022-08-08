@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pedido').' '.$pedido->num_pedido)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <div class="float-right mr-5">
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusVentasHeader')
    </div>
    <h5>
      <strong>{{ __('Datos generales, estas en el pedido') }}:</strong>
      <a href="{{ route('rolCliente.pedido.show', Crypt::encrypt($pedido->id)) }}" class="text-white">{{ $pedido->num_pedido }}</a>
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
</div>
@if($pedido->coment == null)
  <div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
    <div class="card-body">
      {!! Form::open(['route' => ['rolCliente.pedido.update', Crypt::encrypt($pedido->id)], 'method' => 'patch', 'id' => 'rolClientePedidoUpdate']) !!}
        @include('rolCliente.pedido.ped_editFields')
      {!! Form::close() !!}
    </div>
  </div>
@endif
@include('rolCliente.pedido.armado.direccion.dir_index')
@endsection