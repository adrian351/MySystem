@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles factura').' '.$factura->rfc)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    @can('factura.edit')
      <div class="float-right mr-5">
        <a href="{{ route('factura.subirArchivos', Crypt::encrypt($factura->id)) }}" class="btn btn-info btn-sm">{{ __('Subir archivos') }}</a>
      </div>
    @endcan
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('factura.edit')
        <a href="{{ route('factura.edit', Crypt::encrypt($factura->id)) }}" class="text-white">{{ $factura->rfc }}</a>
      @else
        {{ $factura->rfc }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $factura->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('factura.fac_showFields')
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <center><a href="{{ route('factura.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
      </div>
    </div>
  </div>
</div>
@endsection