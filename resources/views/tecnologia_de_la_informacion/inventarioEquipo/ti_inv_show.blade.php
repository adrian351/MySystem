@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles del inventario'))</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles del inventario') }}:</strong>
      @can('inventario.edit')
        <a href="{{ route('inventario.edit', Crypt::encrypt($inventario->id))}}" class="text-white"> {{ $inventario->id_equipo}}</a>
      @else
        {{ $inventario->id_equipo}}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $inventario->id }}</small>
    </div>
  </div>
</div>
@include('tecnologia_de_la_informacion.inventarioEquipo.Archivos.ti_inv_imaInv_index')
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-body">
    @include('tecnologia_de_la_informacion.inventarioEquipo.ti_inv_showFields')
  </div>
</div>
@include('tecnologia_de_la_informacion.inventarioEquipo.historiales.ti_inv_hisInv_index')
@endsection