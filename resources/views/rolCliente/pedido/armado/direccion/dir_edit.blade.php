@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar dirección').' '.$direccion->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar dirección') }}:</strong> {{ $direccion->est }}, <strong>{{ __('del armado') }}:</strong> {{ $direccion->armado->cod }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $direccion->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['rolCliente.pedido.armado.direccion.update', Crypt::encrypt($direccion->id)], 'method' => 'patch', 'id' => 'rolClientePedidoArmadoDireccionUpdate', 'files' => true]) !!}
      @include('rolCliente.pedido.armado.direccion.dir_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection