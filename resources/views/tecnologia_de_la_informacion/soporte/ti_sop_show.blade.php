@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles soporte'))</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles del solicitante') }}:</strong>
      @can('soporte.edit')
        <a href="{{ route('soporte.edit', Crypt::encrypt($soporte->id)) }}" class="text-white">{{ $soporte->sol }}</a>
      @else
        {{ $soporte->sol }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $soporte->id }}</small>
    </div>
  </div>
</div>
@include('tecnologia_de_la_informacion.soporte.archivo.arc_index')
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-body">
    @include('tecnologia_de_la_informacion.soporte.ti_sop_showFields')
  </div>
</div>
@endsection