@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles dirección foráneo').' '.$direccion->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <div class="float-right" style="margin-right: 4rem">
      @include('logistica.pedido.direccion_foraneo.opciones')
    </div>
    <h5>
      <strong>{{ __('Detalles dirección foránea') }}: </strong>{{ $direccion->est }} ({{ Sistema::dosDecimales($direccion->cant) }}),
      <strong>{{ __('para el armado') }}: </strong> {{ $armado->cod }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $direccion->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.dirArm_showFields')
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <center><a href="{{ route('logistica.direccionForaneo.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
      </div>
    </div>
  </div>
</div>
@endsection