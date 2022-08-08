@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar stock').' '.$stock->armados[0]->nom)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      @can('stock.show')
        <a href="{{ route('stock.show', Crypt::encrypt($stock->id)) }}" class="text-white">{{ $stock->armados[0]->nom }}</a>
      @else
        {{ $stock->armados[0]->nom }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $stock->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['stock.update', Crypt::encrypt($stock->id)], 'method' => 'patch', 'id' => 'stockUpdate']) !!}
      @include('stock.sto_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection