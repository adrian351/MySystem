@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar factura').' '.$factura->rfc)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    @can('factura.edit')
      <div class="float-right mr-5">
        <a href="{{ route('factura.subirArchivos', Crypt::encrypt($factura->id)) }}" class="btn btn-info btn-sm">{{ __('Subir archivos') }}</a>
      </div>
    @endcan
    <h5>
      <strong>{{ __('Editar registro') }}:</strong>
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
    {!! Form::open(['route' => ['factura.update', Crypt::encrypt($factura->id)], 'method' => 'patch', 'id' => 'facturaUpdate']) !!}
      @include('factura.fac_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection