@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar armado activo').' '.$armado->cod)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}:</strong>
      @can('produccion.pedidoActivo.armado.show')
        <a href="{{ route('produccion.pedidoActivo.armado.show', Crypt::encrypt($armado->id)) }}" class="text-light">{{ $armado->cod }} ({{ Sistema::dosDecimales($armado->cant) }})</a>
      @else
        {{ $armado->cod }}
      @endcan
      <strong>{{ __('del pedido') }}:</strong> {{ $armado->pedido->num_pedido }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $armado->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['produccion.pedidoActivo.armado.update', Crypt::encrypt($armado->id)], 'method' => 'patch', 'id' => 'produccionPedidoActivoArmadoUpdate']) !!}
     @include('produccion.pedido.pedido_activo.armado_activo.armAct_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection