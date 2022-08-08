@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar manual').' '.$manual->valor)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      @can('manual.show')
        <a href="{{ route('manual.show', Crypt::encrypt($manual->id)) }}" class="text-white" class="text-white">{{ $manual->valor }}</a>
      @else
        {{ $manual->valor }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $manual->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['manual.update', Crypt::encrypt($manual->id)], 'method' => 'patch', 'id' => 'manualUpdate', 'files' => true]) !!}
      @include('sistema.manual.man_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection