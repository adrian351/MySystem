@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar dato fiscal').' '.$dato_fiscal->rfc)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong><a href="{{ route('rolCliente.datoFiscal.show', Crypt::encrypt($dato_fiscal->id)) }}" class="text-white">{{ $dato_fiscal->rfc }}</a>
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $dato_fiscal->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['rolCliente.datoFiscal.update', Crypt::encrypt($dato_fiscal->id)], 'method' => 'patch', 'id' => 'rolClienteDatoFiscalnUpdate']) !!}
      @include('rolCliente.datoFiscal.dfi_editFields')
      <div class="row">
        <div class="form-group col-sm btn-sm" >
          <a href="{{ route('rolCliente.datoFiscal.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'rolClienteDatoFiscalnUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection