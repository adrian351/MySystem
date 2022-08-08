@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Subir archivos factura').' '.$factura->rfc)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Subir archivos') }}:</strong>
      @can('factura.show')
        <a href="{{ route('factura.show', Crypt::encrypt($factura->id)) }}" class="text-white">{{ $factura->rfc }}</a>
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
    {!! Form::open(['route' => ['factura.updateSubirArchivos', Crypt::encrypt($factura->id)], 'method' => 'patch', 'id' => 'facturaUpdateSubirArchivos', 'files' => true]) !!}
      @include('factura.fac_subirArchivosFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection