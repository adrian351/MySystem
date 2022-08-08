@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles historial').' '.$historial->tec)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
        <a href="{{ route('inventario.edit', Crypt::encrypt($historial->id)) }}" class="text-white"> {{ $historial->id}}</a>   
      <strong>{{__('del inventario') }}:</strong> {{ $historial->equipo->id_equipo}}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $historial->id}}</small>
    </div>
  </div>
</div>
@include('tecnologia_de_la_informacion.inventarioEquipo.historiales.archivoshistoriales.ti_inv_hissop')
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-body">
    @include('tecnologia_de_la_informacion.inventarioEquipo.historiales.ti_inv_hisInv_showFields')
  </div>
</div>
@endsection