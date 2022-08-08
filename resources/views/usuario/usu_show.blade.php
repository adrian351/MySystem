@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles usuario').' '.$usuario->nom)</title>
@include('usuario.show.usu_sho_menu')
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('usuario.edit')
        <a href="{{ route('usuario.edit', Crypt::encrypt($usuario->id)) }}" class="text-white">{{ $usuario->nom }}</a>
      @else
        {{ $usuario->nom }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $usuario->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('usuario.usu_showFields')
  </div>
</div>
@endsection