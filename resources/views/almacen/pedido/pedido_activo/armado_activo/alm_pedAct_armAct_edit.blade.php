@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar armado activo').' '.$armado->cod)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}:</strong>
      @can('almacen.pedidoActivo.armado.show')
        <a href="{{ route('almacen.pedidoActivo.armado.show', Crypt::encrypt($armado->id)) }}" class="text-light">{{ $armado->cod }} ({{ Sistema::dosDecimales($armado->cant) }})</a>
      @else
        {{ $armado->cod }}
      @endcan
      <strong>{{ __('del pedido') }}:</strong> {{ $pedido->num_pedido }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $armado->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['almacen.pedidoActivo.armado.update', Crypt::encrypt($armado->id)], 'method' => 'patch', 'id' => 'almacenPedidoActivoArmadoUpdate']) !!}
      @include('almacen.pedido.pedido_activo.armado_activo.alm_pedAct_armAct_editFields')
    {!! Form::close() !!}
  </div>
</div>
@include('almacen.pedido.pedido_activo.armado_activo.productos_armado.alm_pedAct_armAct_proAct_index')
@endsection