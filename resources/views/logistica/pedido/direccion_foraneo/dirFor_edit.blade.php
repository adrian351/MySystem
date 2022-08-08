@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar dirección foráneo').' '.$direccion->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <div class="float-right" style="margin-right: 4rem">
      @include('logistica.pedido.direccion_foraneo.opciones')
    </div>
    <h5>
      <strong>{{ __('Editar dirección foránea') }}: </strong>{{ $direccion->est }} ({{ Sistema::dosDecimales($direccion->cant) }}),
      <strong>{{ __('para el armado') }}: </strong> {{ $armado->cod }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $direccion->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['logistica.direccionForaneo.update', Crypt::encrypt($direccion->id)], 'method' => 'patch', 'id' => 'logisticaDireccionForaneoUpdate', 'files' => true]) !!}
      @include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.dirArm_editFields')
      <div class="row">
        <div class="form-group col-sm btn-sm" >
          <a href="{{ route('logistica.direccionForaneo.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'logisticaDireccionForaneoUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection