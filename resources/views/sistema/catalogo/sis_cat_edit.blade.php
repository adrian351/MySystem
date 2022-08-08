@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar catálogo').' '.$catalogo->vista)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      @can('sistema.catalogo.show')
        <a href="{{ route('sistema.catalogo.show', Crypt::encrypt($catalogo->id)) }}" class="text-white">{{ $catalogo->vista }}</a>
      @else
        {{ $catalogo->vista }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $catalogo->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['sistema.catalogo.update', Crypt::encrypt($catalogo->id)], 'method' => 'patch', 'id' => 'sistemaCatalogoUpdate', 'files' => true]) !!}
      @include('sistema.catalogo.sis_cat_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection