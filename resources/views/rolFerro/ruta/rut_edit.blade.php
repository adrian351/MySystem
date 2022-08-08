@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar ruta').' '.$ruta->nom)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
        <a href="{{ route('rolFerro.ruta.show', Crypt::encrypt($ruta->id)) }}" class="text-white">{{ $ruta->nom }}</a>
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $ruta->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['rolFerro.ruta.update', Crypt::encrypt($ruta->id)], 'method' => 'patch', 'id' => 'rolFerroRutaUpdate']) !!}
      @include('rolFerro.ruta.rut_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection