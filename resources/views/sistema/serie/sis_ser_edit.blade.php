@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar serie').' '.$serie->vista)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      @can('sistema.serie.show')
        <a href="{{ route('sistema.serie.show', Crypt::encrypt($serie->id)) }}" class="text-white" class="text-white">{{ $serie->vista }}</a>
      @else
        {{ $serie->vista }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $serie->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['sistema.serie.update', Crypt::encrypt($serie->id)], 'method' => 'patch', 'id' => 'sistemaSerieUpdate']) !!}
      @include('sistema.serie.sis_ser_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection