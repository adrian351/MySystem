@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar plantilla').' '.$plantilla->nom)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}:</strong>
      @can('sistema.plantilla.show')
        <a href="{{ route('sistema.plantilla.show', Crypt::encrypt($plantilla->id)) }}" class="text-white">{{ $plantilla->nom }}</a>
      @else
        {{ $plantilla->nom }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $plantilla->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['sistema.plantilla.update', Crypt::encrypt($plantilla->id)], 'method' => 'patch', 'id' => 'sistemaPlantillaUpdate', 'files' => true]) !!}
      @include('sistema.plantilla.sis_pla_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection