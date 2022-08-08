@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles dirección').' '.$direccion->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles dirección') }}:</strong>
      @can('venta.pedidoActivo.armado.direccion.edit')
        <a href="{{ route('venta.pedidoActivo.armado.direccion.edit', Crypt::encrypt($direccion->id)) }}" class="text-white">{{ $direccion->est }} ({{ Sistema::dosDecimales($direccion->cant) }})</a>,
      @else
        {{ $direccion->est }},
      @endcan
     <strong>{{ __('del armado') }}:</strong> {{ $direccion->armado->cod }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $direccion->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_showFields')
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <center><a href="{{ route('venta.pedidoActivo.armado.show', Crypt::encrypt($direccion->pedido_armado_id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Continuar con el pedido') }}</a></center>
      </div>
    </div>
  </div>
</div>
@endsection