@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar rol').' '.$rol->nom)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}:</strong>
      @can('rol.show')
        <a href="{{ route('rol.show', Crypt::encrypt($rol->id)) }}" class="text-white">{{ $rol->nom }}</a>
      @else
        {{ $rol->nom }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $rol->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['rol.update', Crypt::encrypt($rol->id)], 'method' => 'patch', 'id' => 'rolUpdate']) !!}
      @include('rol.rol.rol_rol_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection