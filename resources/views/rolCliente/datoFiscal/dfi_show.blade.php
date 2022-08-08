@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles dato fiscal').' '.$dato_fiscal->rfc)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong> <a href="{{ route('rolCliente.datoFiscal.edit', Crypt::encrypt($dato_fiscal->id)) }}" class="text-white">{{ $dato_fiscal->rfc }}</a>
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $dato_fiscal->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('rolCliente.datoFiscal.dfi_showFields')
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <center><a href="{{ route('rolCliente.datoFiscal.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
      </div>
    </div>
  </div>
</div>
@endsection